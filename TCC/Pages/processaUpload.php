<?php
$mensagem = "";
$sucesso = false;

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $pasta = "../uploads/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeOriginal = basename($_FILES['arquivo']['name']);
    $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    $novoNome = "arquivo_" . uniqid() . "." . $extensao;
    $destino = $pasta . $novoNome;

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino)) {
        $sucesso = true;
        $mensagem = "Arquivo enviado com sucesso!";
    } else {
        $mensagem = "Não foi possível enviar o arquivo.";
    }
} else {
    $mensagem = "Nenhum arquivo foi selecionado ou ocorreu um erro no envio.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once '../Config/header.php'; ?>
        <title>Upload - EasyMigra</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #0d47a1, #1976d2);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .card {
                background: #fff;
                width: 420px;
                padding: 35px;
                border-radius: 14px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.18);
                text-align: center;
            }

            .icone {
                font-size: 48px;
                margin-bottom: 15px;
            }

            h1 {
                margin-bottom: 10px;
                color: #222;
            }

            p {
                color: #555;
                font-size: 16px;
            }

            .sucesso {
                color: #2e7d32;
            }

            .erro {
                color: #c62828;
            }

            .arquivo {
                background: #f1f5f9;
                padding: 10px;
                border-radius: 8px;
                margin: 18px 0;
                font-size: 14px;
                word-break: break-word;
            }

            a {
                display: inline-block;
                margin-top: 18px;
                padding: 12px 22px;
                background: #2563eb;
                color: white;
                text-decoration: none;
                border-radius: 8px;
                font-weight: bold;
            }

            a:hover {
                background: #1d4ed8;
            }
        </style>
    </head>
    <body>

        <div class="card">
            <div class="icone">
                <?php echo $sucesso ? "✅" : "⚠️"; ?>
            </div>

            <h1 class="<?php echo $sucesso ? 'sucesso' : 'erro'; ?>">
                <?php echo $sucesso ? "Upload concluído" : "Erro no upload"; ?>
            </h1>

            <p><?php echo $mensagem; ?></p>

            <?php if ($sucesso): ?>
                <div class="arquivo">
                    <?php echo htmlspecialchars($novoNome); ?>
                </div>
            <?php endif; ?>

            <a href="uploadArquivo.php">Voltar</a>
            <a href="mainPage.php">Página inicial</a>
        </div>

        <script src="/TCC/registrar-sw.js"></script>
    </body>
</html>
