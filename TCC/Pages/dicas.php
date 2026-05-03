<?php
require_once '../Config/auth.php';
require_once '../Services/dicaService.php';

$service = new DicaService();
$id_usuario = $_SESSION['usuario']['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = trim($_POST['texto'] ?? '');
    if ($texto !== '') $service->cadastrar($id_usuario, $texto);
    header('Location: dicas.php'); exit;
}
$dicas = $service->listar();
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><title>Dicas - EasyMigra</title><style>
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:800px;margin:30px auto;background:white;padding:25px;border-radius:10px} textarea{width:100%;height:80px} button{padding:10px;margin-top:8px}.dica{border-bottom:1px solid #ddd;padding:12px 0;color:#333}.autor{font-size:13px;color:#666}
</style></head><body><main>
<h2>Dicas da Comunidade</h2>
<form method="POST"><textarea name="texto" placeholder="Compartilhe uma dica útil para outros imigrantes" required></textarea><button type="submit">Publicar dica</button></form>
<?php foreach($dicas as $d): ?><div class="dica"><p><?php echo htmlspecialchars($d['texto']); ?></p><p class="autor">Por <?php echo htmlspecialchars($d['autor'] ?? 'Usuário'); ?> em <?php echo date('d/m/Y', strtotime($d['data_publicacao'])); ?></p></div><?php endforeach; ?>
<p><a href="mainPage.php">Voltar</a></p>
</main></body></html>
