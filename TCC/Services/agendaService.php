<?php
require_once __DIR__ . '/../Config/conexao.php';

class AgendaService {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listarPorUsuario($id_usuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM Agenda WHERE fk_Usuario_id_usuario = ? ORDER BY data_evento ASC");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($id_usuario, $data_evento, $descricao) {
        $id = (int)$this->pdo->query("SELECT COALESCE(MAX(id_agenda),0)+1 FROM Agenda")->fetchColumn();
        $stmt = $this->pdo->prepare("INSERT INTO Agenda (id_agenda, data_evento, descricao, fk_Usuario_id_usuario) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id, $data_evento, $descricao, $id_usuario]);
    }

    public function excluir($id_agenda, $id_usuario) {
        $stmt = $this->pdo->prepare("DELETE FROM Agenda WHERE id_agenda = ? AND fk_Usuario_id_usuario = ?");
        return $stmt->execute([$id_agenda, $id_usuario]);
    }
}
