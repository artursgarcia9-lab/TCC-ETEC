<?php require_once '../Config/auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><title>Upload - EasyMigra</title><style>
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:600px;margin:30px auto;background:white;padding:25px;border-radius:10px} input,button{padding:10px;margin-top:10px}
</style></head><body><main>
<h2>Upload de Arquivo</h2>
<p>Envie arquivos em PDF, imagem ou documento de texto.</p>
<form action="processaUpload.php" method="POST" enctype="multipart/form-data"><input type="file" name="arquivo" required><br><button type="submit">Enviar</button></form>
<p><a href="mainPage.php">Voltar</a></p>
</main></body></html>
