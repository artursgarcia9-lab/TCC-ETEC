<?php

session_start();

require_once "../Services/usuarioService.php";
// Verifica se veio via POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Sanitização básica
$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

// Validação
if (empty($email) || empty($senha)) {
    header("Location: index.php?erro=campos_vazios");
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?erro=email_invalido");
    exit;
}

$service = new UsuarioService();

$usuario = $service->login($email, $senha);
if ($usuario) {

    // Regenera sessão (segurança contra session fixation)
    session_regenerate_id(true);

    $_SESSION['usuario'] = [
        'id' => $usuario['id_usuario'],
        'nome' => $usuario['nome'],
        'email' => $usuario['email'],
        'nivel_acesso' => $usuario['nivel_acesso']
    ];
    // Redireciona corretamente
    header("Location: mainPage.php");
    exit;

} else {
    // Login inválido, retorna erro
    header("Location: index.php?erro=login_invalido");
    exit;
}
?>