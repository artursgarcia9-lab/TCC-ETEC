<?php
require_once "../config/auth_admin.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Criar Administrador</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    width: 350px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

button {
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: #1e7e34;
}

a {
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
}
</style>
</head>

<body>

<div class="container">
    <h2>Criar Administrador</h2>

    <form action="salvarAdmin.php" method="POST">

        ID do Usuário:
        <input type="number" name="id_usuario" required>

        Nível de Acesso:
        <select name="nivel">
            <option value="1">Básico</option>
            <option value="2">Intermediário</option>
            <option value="3">Avançado</option>
        </select>

        Cargo:
        <input type="text" name="cargo" required>

        <button type="submit">Tornar Administrador</button>
    </form>

    <a href="dashboard.php">Voltar</a>
</div>

</body>
</html>