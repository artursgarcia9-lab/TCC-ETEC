<?php
session_start();

// tempo limite (ex: 10 minutos = 600 segundos)
$tempoLimite = 600;

if (isset($_SESSION['ultimo_acesso'])) {
    $tempoInativo = time() - $_SESSION['ultimo_acesso'];

    if ($tempoInativo > $tempoLimite) {
        session_unset();
        session_destroy();
        header("Location: index.php?erro=sessao_expirada");
        exit;
    }
}

// atualiza o tempo
$_SESSION['ultimo_acesso'] = time();

// proteção básica
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>