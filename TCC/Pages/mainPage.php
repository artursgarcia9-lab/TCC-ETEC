<?php
require_once "../Config/auth.php";
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyMigra - Início</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; }
        header { background: #4e73df; color: white; padding: 20px; }
        main { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .card a, button { display: inline-block; margin-top: 10px; padding: 10px 14px; background: #4e73df; color: white; border: 0; border-radius: 6px; text-decoration: none; cursor: pointer; }
        .danger { background: #dc3545; }
        .top { display:flex; justify-content:space-between; align-items:center; gap:16px; }
    </style>
</head>
<body>
<header class="top">
    <div>
        <h2>EasyMigra</h2>
        <p>Bem-vindo(a), <?php echo htmlspecialchars($usuario['nome']); ?></p>
    </div>
    <form action="logout.php" method="POST"><button type="submit">Sair</button></form>
</header>
<main>
    <div class="grid">
        <div class="card"><h3>Documentos</h3><p>Consultar orientações sobre CPF, RNM, trabalho, saúde e educação.</p><a href="documentos.php">Acessar</a></div>
        <div class="card"><h3>Órgãos públicos</h3><p>Consultar unidades e contatos cadastrados.</p><a href="orgaos.php">Acessar</a></div>
        <div class="card"><h3>Agenda de prazos</h3><p>Cadastrar e acompanhar datas importantes.</p><a href="agenda.php">Acessar</a></div>
        <div class="card"><h3>Dicas da comunidade</h3><p>Compartilhar orientações úteis com outros usuários.</p><a href="dicas.php">Acessar</a></div>
        <div class="card"><h3>Upload de arquivos</h3><p>Enviar arquivos de apoio, como comprovantes e documentos.</p><a href="uploadArquivo.php">Acessar</a></div>
        <div class="card"><h3>Minha conta</h3><p>Excluir a própria conta, se necessário.</p><a class="danger" href="deletarConta.php">Excluir conta</a></div>
        <?php if ($usuario['nivel_acesso'] !== null): ?>
            <div class="card"><h3>Administração</h3><p>Gerenciar usuários administradores.</p><a href="formAdmin.php">Tornar usuário admin</a><a href="listarUsuario.php">Listar usuários</a></div>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
