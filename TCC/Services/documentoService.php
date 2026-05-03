<?php
require_once __DIR__ . '/../Config/conexao.php';

class DocumentoService {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listar() {
        $sql = "SELECT d.*, f.nome AS fonte_nome, f.url AS fonte_url
                FROM Documento d
                LEFT JOIN Origem o ON d.id_documento = o.fk_Documento_id_documento
                LEFT JOIN Fonte_Oficial f ON o.fk_Fonte_Oficial_id_fonte = f.id_fonte
                ORDER BY d.tipo, d.descricao";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorTipo($tipo) {
        $sql = "SELECT * FROM Documento WHERE tipo LIKE ? OR descricao LIKE ? ORDER BY tipo";
        $stmt = $this->pdo->prepare($sql);
        $termo = '%' . $tipo . '%';
        $stmt->execute([$termo, $termo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($tipo, $descricao, $requisitos, $id_fonte = null) {
        $id = (int)$this->pdo->query("SELECT COALESCE(MAX(id_documento),0)+1 FROM Documento")->fetchColumn();
        $stmt = $this->pdo->prepare("INSERT INTO Documento (id_documento, tipo, descricao, requisitos, id_fonte) VALUES (?, ?, ?, ?, ?)");
        $ok = $stmt->execute([$id, $tipo, $descricao, $requisitos, $id_fonte]);
        if ($ok && $id_fonte) {
            $origem = $this->pdo->prepare("INSERT INTO Origem (fk_Documento_id_documento, fk_Fonte_Oficial_id_fonte) VALUES (?, ?)");
            $origem->execute([$id, $id_fonte]);
        }
        return $ok;
    }

    public function registrarConsulta($id_usuario, $id_documento) {
        $stmt = $this->pdo->prepare("INSERT INTO Consulta (fk_Usuario_id_usuario, fk_Documento_id_documento) VALUES (?, ?)");
        return $stmt->execute([$id_usuario, $id_documento]);
    }
}
