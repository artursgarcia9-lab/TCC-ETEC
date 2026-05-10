<?php
require_once "../Config/auth.php";
?>
<h2>Dashboard</h2>
<p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?></p>
<ul>
    <li><a href="listarUsuario.php">Listar Usuários</a></li>
    <li><a href="formAdmin.php">Criar Administrador</a></li>
    <li><a href="documentos.php">Consultar Documentos</a></li>
    <li><a href="orgaos.php">Consultar Órgãos</a></li>
    <li><a href="agenda.php">Agenda</a></li>
    <li><a href="dicas.php">Dicas</a></li>
    <li><a href="chat.php">Chat de Apoio</a></li>
    <li><a href="uploadArquivo.php">Upload de Arquivos</a></li>
    <li><a href="logout.php">Sair</a></li>
</ul>
