<?php

session_start();

// Verifica se está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

// Verifica se é admin
if ($_SESSION['usuario']['nivel_acesso'] === null) {
    die("Acesso restrito: apenas administradores.");
}
?>