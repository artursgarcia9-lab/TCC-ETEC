<?php
require_once '../Config/auth.php';
require_once '../Services/agendaService.php';

$service = new AgendaService();
$id_usuario = $_SESSION['usuario']['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        $service->excluir($_POST['id_agenda'], $id_usuario);
    } else {
        $service->cadastrar($id_usuario, $_POST['data_evento'], $_POST['descricao']);
    }
    header('Location: agenda.php'); exit;
}
$eventos = $service->listarPorUsuario($id_usuario);
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><title>Agenda - EasyMigra</title><style>
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:800px;margin:30px auto;background:white;padding:25px;border-radius:10px} input,button{padding:10px;margin:5px 0} table{width:100%;border-collapse:collapse} th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} .danger{background:#dc3545;color:white;border:0;border-radius:4px}
</style></head><body><main>
<h2>Agenda de Prazos</h2>
<form method="POST">
    <input type="date" name="data_evento" required>
    <input type="text" name="descricao" placeholder="Ex.: renovar RNM" required>
    <button type="submit">Cadastrar prazo</button>
</form>
<table><tr><th>Data</th><th>Descrição</th><th>Ação</th></tr>
<?php foreach($eventos as $e): ?>
<tr><td><?php echo date('d/m/Y', strtotime($e['data_evento'])); ?></td><td><?php echo htmlspecialchars($e['descricao']); ?></td><td><form method="POST"><input type="hidden" name="id_agenda" value="<?php echo $e['id_agenda']; ?>"><button class="danger" name="excluir" value="1">Excluir</button></form></td></tr>
<?php endforeach; ?>
</table>
<p><a href="mainPage.php">Voltar</a></p>
</main></body></html>
