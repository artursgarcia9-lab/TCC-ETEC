<?php require_once '../Config/auth.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once '../Config/header.php'; ?>
        <title>Excluir Conta</title>
        <style>
        body{
            font-family:Arial,sans-serif;
            background:#f4f6f9
        }
        main{
            max-width:500px;
            margin:40px auto;
            background:white;
            padding:25px;
            border-radius:10px
        }
        .danger{
            background:#dc3545;
            color:white;
            border:0;
            border-radius:6px;
            padding:10px
        }
        </style>
    </head>
    <body>
        <main>
            <h2>Excluir conta</h2>
            <p>Essa ação removerá sua conta e os dados relacionados, como agenda e dicas cadastradas.</p>
            <form action="excluirConta.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                <button class="danger" type="submit">Confirmar exclusão</button>
            </form>
            <p>
                <a href="mainPage.php">Cancelar</a>
            </p>
        </main>
    
        <script src="/TCC/registrar-sw.js"></script>
    </body>
</html>