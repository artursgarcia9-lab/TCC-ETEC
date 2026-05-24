<?php
require_once "../Config/auth.php";
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once '../Config/header.php'; ?>
        <title>EasyMigra - Início</title>
        <link rel="stylesheet" href="../css/style_dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body { font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; }
            header { background: #4e73df; color: white; padding: 20px; }
            main { max-width: 900px; margin: 30px auto; padding: 0 20px; }
            .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
            .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
            .card a, button { display: inline-block; margin-top: 10px; padding: 10px 14px; background: #4e73df; color: white; 
            border: 0; border-radius: 6px; text-decoration: none; cursor: pointer; }
            .danger { background: #dc3545; }
            .top { display:flex; justify-content:space-between; align-items:center; gap:16px; }
        </style>
    </head>
    <body>
        <header class="app-header" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px;">
        <!-- Ícone de Menu -->
            <i class="fa-solid fa-bars"></i>

            <!-- Container Centralizado (ou alinhado) -->
            <header style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 10px 15px; 
            background: white; position: relative; height: 60px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                
                <div style="z-index: 2;">
                    <i class="fa-solid fa-bars" style="font-size: 20px; color: #555; cursor: pointer;"></i>
                </div>

                <div style="position: absolute; left: 50%; transform: translateX(-50%); display: flex; align-items: center; gap: 8px; white-space: nowrap;">
                    <img src="../img/glob.jpg" alt="Glob" 
                        style="width: 35px; height: 35px; object-fit: cover;" 
                        class="w3-circle">
                    
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <strong style="font-size: 16px; color: #224abe; line-height: 1.1;">EasyMigra</strong>
                        <small style="font-size: 9px; color: #777; margin-top: 1px;">Apoio para sua vida no Brasil</small>
                    </div>
                </div>

                <div style="position: relative; cursor: pointer; z-index: 2;">
                    <i class="fa-solid fa-bell" style="font-size: 20px; color: #555;"></i>
                    <span style="position: absolute; top: -2px; right: -2px; background-color: red; width: 8px; height: 8px; border-radius: 50%; border: 2px solid white;"></span>
                </div>

            </header>
        </header>

        <main>
            <section class="welcome-banner" style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
            <!-- Container para os textos ficarem na esquerda -->
            <div class="welcome-text">
                <h1 style="margin: 0;">Bem-vindo ao EasyMigra!</h1>
                <p style="margin: 5px 0;">Informação, orientação e apoio para imigrantes no Brasil.</p>
                <small>Olá, <?php echo $_SESSION['usuario']['nome']; ?></small>
            </div>

            <!-- Imagem na extrema direita -->
            <img src="../img/pess.jpg" alt="Pess" style="width: 100px; height: 100px; object-fit: cover;" class="w3-circle">
        </section>

            <section class="menu-grid">
                <a href="documentos.php" class="menu-card">
                    <i class="fa-solid fa-file-invoice icon-green"></i>
                    <span>Documentos</span>
                </a>

                <a href="orgaos.php" class="menu-card">
                    <i class="fa-solid fa-location-dot icon-purple"></i>
                    <span>Órgãos</span>
                </a>

                <a href="agenda.php" class="menu-card">
                    <i class="fa-solid fa-calendar-days icon-orange"></i>
                    <span>Agenda</span>
                </a>

                <a href="dicas.php" class="menu-card">
                    <i class="fa-solid fa-comments icon-green"></i>
                    <span>Dicas</span>
                </a>

                <a href="chat.php" class="menu-card">
                    <i class="fa-solid fa-comment icon-blue"></i>
                    <span>Chat de Apoio</span>
                </a>

                <a href="upload.php" class="menu-card">
                    <i class="fa-solid fa-language icon-blue"></i>
                    <span>Tradutor</span>
                </a>
            </section>

            <section class="info-bar">
                <i class="fa-solid fa-circle-info"></i>
                <p>Encontre aqui tudo o que você precisa para regularizar sua vida e se integrar ao Brasil.</p>
            </section>
        </main>

        <nav class="bottom-nav">
            <a href="mainPage.php" class="nav-item active"><i class="fa-solid fa-house"></i>Início</a>
            <a href="documentos.php" class="nav-item"><i class="fa-solid fa-file-lines"></i>Documentos</a>
            <a href="agenda.php" class="nav-item"><i class="fa-solid fa-calendar"></i>Agenda</a>
            <a href="dicas.php" class="nav-item"><i class="fa-solid  fa-star"></i>Dicas</a>
            <a href="perfil.php" class="nav-item"><i class="fa-solid fa-user"></i>Perfil</a>
        </nav>

        <script src="/TCC/registrar-sw.js"></script>
    </body>
</html>

