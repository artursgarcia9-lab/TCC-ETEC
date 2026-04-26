<?php
require_once "../config/auth.php";
?>

<h2>Dashboard</h2>

<p>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?></p>

<ul>
    <li><a href="listar_usuarios.php">Listar Usuários</a></li>
    <li><a href="form_admin.php">Criar Administrador</a></li>
    <li><a href="logout.php">Sair</a></li>
</ul>