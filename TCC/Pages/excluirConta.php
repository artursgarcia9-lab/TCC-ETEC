<?php
require_once '../Config/auth.php';
require_once '../Config/conexao.php';

$id = $_SESSION['usuario']['id'] ?? null;
if ($id) {
    $pdo = Conexao::conectar();
    $stmt = $pdo->prepare('DELETE FROM Usuario WHERE id_usuario = ?');
    $stmt->execute([$id]);
}
session_unset();
session_destroy();
header('Location: index.php');
exit;
