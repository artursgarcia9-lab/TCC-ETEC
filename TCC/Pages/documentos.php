<?php
require_once '../Config/auth.php';
require_once '../Services/documentoService.php';

$service = new DocumentoService();
$termo = trim($_GET['busca'] ?? '');
$documentos = $termo ? $service->buscarPorTipo($termo) : $service->listar();
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><title>Documentos - EasyMigra</title><style>
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:900px;margin:30px auto;background:white;padding:25px;border-radius:10px} table{width:100%;border-collapse:collapse} th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} input,button{padding:10px;margin:5px 0} a{color:#4e73df}
</style></head><body><main>
<h2>Consulta de Documentos</h2>
<form method="GET"><input type="text" name="busca" placeholder="Buscar por CPF, RNM, trabalho..." value="<?php echo htmlspecialchars($termo); ?>"><button type="submit">Buscar</button></form>
<table><tr><th>Tipo</th><th>Descrição</th><th>Requisitos</th><th>Fonte</th></tr>
<?php foreach($documentos as $d): ?>
<tr><td><?php echo htmlspecialchars($d['tipo'] ?? ''); ?></td><td><?php echo htmlspecialchars($d['descricao'] ?? ''); ?></td><td><?php echo htmlspecialchars($d['requisitos'] ?? ''); ?></td><td><?php echo htmlspecialchars($d['fonte_nome'] ?? ''); ?></td></tr>
<?php endforeach; ?>
</table>
<p><a href="mainPage.php">Voltar</a></p>
</main></body></html>
