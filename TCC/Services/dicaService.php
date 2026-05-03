<?php
require_once __DIR__ . '/../Config/conexao.php';

class DicaService {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listar() {
        $sql = "SELECT d.*, u.nome AS autor
                FROM Dica d
                LEFT JOIN Usuario u ON d.fk_Usuario_id_usuario = u.id_usuario
                ORDER BY d.data_publicacao DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($id_usuario, $texto) {
        $id = (int)$this->pdo->query("SELECT COALESCE(MAX(id_dica),0)+1 FROM Dica")->fetchColumn();
        $stmt = $this->pdo->prepare("INSERT INTO Dica (id_dica, texto, data_publicacao, fk_Usuario_id_usuario) VALUES (?, ?, CURDATE(), ?)");
        return $stmt->execute([$id, $texto, $id_usuario]);
    }
}
