<?php
require_once '../Config/auth.php';
require_once '../Services/orgaoService.php';

$service = new OrgaoService();
$termo = trim($_GET['busca'] ?? '');
$orgaos = $termo ? $service->buscar($termo) : $service->listar();
?>
<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="UTF-8"><title>Órgãos Públicos - EasyMigra</title>
<link rel="stylesheet" href="../css/style_dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:900px;margin:30px auto;background:white;padding:25px;border-radius:10px} table{width:100%;border-collapse:collapse} th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} input,button{padding:10px;margin:5px 0} a{color:#4e73df}
</style></head>
<body><header class="app-header-orgaos">
    <a href="mainPage.php" style="color: white;"><i class="fa-solid fa-arrow-left"></i></a>
    <h2>Órgãos Públicos</h2>
    <i class="fa-solid fa-sliders"></i> <!-- Ícone de filtro da imagem -->
</header>

<main class="orgaos-page">
    <p class="intro-text">Encontre órgãos públicos perto de você.</p>

    <!-- Área do Mapa -->
    <div class="map-container">
        <!-- Placeholder da imagem do mapa -->
        <img src="img/mapa_exemplo.png" alt="Mapa" class="map-img">
    </div>

    <!-- Lista de Locais -->
    <div class="location-list">
        
        <!-- Card: Polícia Federal -->
        <div class="location-card">
            <div class="pin-icon green-pin">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="location-info">
                <strong>Polícia Federal</strong>
                <span>Av, Paulista, 1357- Bela Vista, SP</span>
            </div>
            <div class="location-distance">1,2 km</div>
        </div>

        <!-- Card: CRAS -->
        <div class="location-card">
            <div class="pin-icon red-pin">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="location-info">
                <strong>CRAS - Centro de Referência</strong>
                <span>R. da Consolação, 123 - Consolação, SP</span>
            </div>
            <div class="location-distance">1,8 km</div>
        </div>

        <!-- Card: Receita Federal -->
        <div class="location-card">
            <div class="pin-icon blue-pin">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="location-info">
                <strong>Receita Federal</strong>
                <span>Av. Prestes Maia, 733 - Luz, São Paulo - SP</span>
            </div>
            <div class="location-distance">2,3 km</div>
        </div>

    </div>
</main>

<!-- Barra Inferior (Certifique-se que o item 'Órgãos' esteja active) -->
<nav class="bottom-nav">
    <a href="mainPage.php" class="nav-item">
        <i class="fa-solid fa-house"></i>
        <span>Início</span>
    </a>
    <a href="documentos.php" class="nav-item">
        <i class="fa-solid fa-file-lines"></i>
        <span>Documentos</span>
    </a>
    <a href="orgaos.php" class="nav-item active">
        <i class="fa-solid fa-location-dot"></i>
        <span>Órgãos</span>
    </a>
    <a href="agenda.php" class="nav-item">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Agenda</span>
    </a>
    <a href="perfil.php" class="nav-item">
        <i class="fa-solid fa-user"></i>
        <span>Perfil</span>
    </a>
</nav>
<main>
<!--<h2>Localização de Órgãos Públicos</h2>
<form method="GET"><input type="text" name="busca" placeholder="Buscar por nome ou endereço" value="<?php echo htmlspecialchars($termo); ?>"><button type="submit">Buscar</button></form>
<table><tr><th>Nome</th><th>Endereço</th><th>Contato</th></tr>
<?php foreach($orgaos as $o): ?>
<tr><td><?php echo htmlspecialchars($o['nome']); ?></td><td><?php echo htmlspecialchars($o['endereco']); ?></td><td><?php echo htmlspecialchars($o['contato']); ?></td></tr>
<?php endforeach; ?>
</table>
<p><a href="mainPage.php">Voltar</a></p>-->
</main></body></html>
