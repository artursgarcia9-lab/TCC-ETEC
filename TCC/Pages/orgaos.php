<?php
require_once '../Config/auth.php';
require_once '../Services/orgaoService.php';

$service = new OrgaoService();
$termo = trim($_GET['busca'] ?? '');
$orgaos = $termo ? $service->buscar($termo) : $service->listar();
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><title>Órgãos Públicos - EasyMigra</title><style>
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:900px;margin:30px auto;background:white;padding:25px;border-radius:10px} table{width:100%;border-collapse:collapse} th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} input,button{padding:10px;margin:5px 0} a{color:#4e73df}
</style></head><body><main>
<h2>Localização de Órgãos Públicos</h2>
<form method="GET"><input type="text" name="busca" placeholder="Buscar por nome ou endereço" value="<?php echo htmlspecialchars($termo); ?>"><button type="submit">Buscar</button></form>
<table><tr><th>Nome</th><th>Endereço</th><th>Contato</th></tr>
<?php foreach($orgaos as $o): ?>
<tr><td><?php echo htmlspecialchars($o['nome']); ?></td><td><?php echo htmlspecialchars($o['endereco']); ?></td><td><?php echo htmlspecialchars($o['contato']); ?></td></tr>
<?php endforeach; ?>
</table>
<p><a href="mainPage.php">Voltar</a></p>
</main></body></html>
