<?php
$erro = $_GET['erro'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - EasyMigra</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #4e73df, #224abe);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: white;
    padding: 30px;
    width: 350px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 8px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: 0.3s;
}

input:focus {
    border-color: #4e73df;
    outline: none;
    box-shadow: 0 0 5px rgba(78,115,223,0.5);
}

button {
    width: 100%;
    padding: 12px;
    background: #4e73df;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

button:hover {
    background: #2e59d9;
}

.error {
    background: #ffe0e0;
    color: #c00;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
}

a {
    display: block;
    margin-top: 15px;
    text-decoration: none;
    color: #4e73df;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="container">
    <h2>EasyMigra</h2>

    <?php if ($erro == 'campos_vazios'): ?>
        <div class="error">Preencha todos os campos.</div>
    <?php elseif ($erro == 'email_invalido'): ?>
        <div class="error">Email inválido.</div>
    <?php elseif ($erro == 'login_invalido'): ?>
        <div class="error">Email ou senha incorretos.</div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit">Entrar</button>
    </form>

    <a href="formUsuario.php">Criar uma conta</a>
</div>

</body>
</html>