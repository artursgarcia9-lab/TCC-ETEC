<?php
require_once __DIR__ . '/../Config/conexao.php';

class OrgaoService {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listar() {
        return $this->pdo->query("SELECT * FROM Orgao ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($termo) {
        $stmt = $this->pdo->prepare("SELECT * FROM Orgao WHERE nome LIKE ? OR endereco LIKE ? ORDER BY nome");
        $like = '%' . $termo . '%';
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $endereco, $contato) {
        $id = (int)$this->pdo->query("SELECT COALESCE(MAX(id_orgao),0)+1 FROM Orgao")->fetchColumn();
        $stmt = $this->pdo->prepare("INSERT INTO Orgao (id_orgao, nome, endereco, contato) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id, $nome, $endereco, $contato]);
    }
}
