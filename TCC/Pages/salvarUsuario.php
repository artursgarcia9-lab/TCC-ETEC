<?php

session_start();

require_once "../Models/usuario.php";
require_once "../Services/usuarioService.php";

// Verifica método
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: formUsuario.php");
    exit;
}

// Sanitização
$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');
$confirmar = trim($_POST['confirmar_senha'] ?? '');

// Validação
if (empty($email) || empty($senha)) {
    header("Location: formUsuario.php?erro=campos_vazios");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: formUsuario.php?erro=email_invalido");
    exit;
}

if ($senha !== $confirmar) {
    header("Location: formUsuario.php?erro=senha_diferente");
    exit;
}

$nome = trim($_POST['nome'] ?? '');
if (strlen($nome) < 3) {
    header("Location: formUsuario.php?erro=nome_invalido");
    exit;
}
// Cria usuário
$usuario = new Usuario(
    $_POST['nome'],
    $email,
    $senha
);

// Agora seta os outros campos
$usuario->setStatusResidencia($_POST['status']);
$usuario->setApelido($_POST['apelido']);
$usuario->setIdioma($_POST['idioma']);
$usuario->setPaisOrigem($_POST['pais']);

$service = new UsuarioService();

if ($service->cadastrar($usuario)) {

    // LOGIN AUTOMÁTICO
    $_SESSION['usuario'] = [
        'nome' => $_POST['nome'],
        'email' => $email,
        'nivel_acesso' => null
    ];

    header("Location: mainPage.php");
    exit;

} else {
    header("Location: formUsuario.php?erro=erro_cadastro");
    exit;
}