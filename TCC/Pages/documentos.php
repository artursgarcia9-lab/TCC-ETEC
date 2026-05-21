<?php
require_once '../Config/auth.php';
require_once '../Services/documentoService.php';

$service = new DocumentoService();
$termo = trim($_GET['busca'] ?? '');
$documentos = $termo ? $service->buscarPorTipo($termo) : $service->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once '../Config/header.php'; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../css/style_dashboard.css">
        <style>
        body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} 
        main{max-width:900px;margin:30px auto;background:white;padding:25px;border-radius:10px} 
        table{width:100%;border-collapse:collapse} 
        th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} 
        input,button{padding:10px;margin:5px 0} 
        a{color:#4e73df}
        </style>
    </head>
    <body>
        <header class="app-header-docs">
            <a href="mainPage.php" style="color: white;"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Documentos</h2>
            <i class="fa-solid fa-magnifying-glass"></i>
        </header><div class="documentos-page">
            <!-- Texto de Apoio Superior -->
            <p class="intro-text">Encontre informações sobre os principais documentos no Brasil.</p>

            <!-- Lista de Cards de Navegação -->
            <div class="nav-list">
                
                <!-- Card: Residência -->
                <a href="detalhes_residencia.php" class="nav-card">
                    <div class="card-icon-circle green">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <div class="card-info">
                        <strong>Residência</strong>
                        <span>Documentos para viver legalmente no Brasil.</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </a>

                <!-- Card: Trabalho -->
                <a href="detalhes_trabalho.php" class="nav-card">
                    <div class="card-icon-circle blue">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="card-info">
                        <strong>Trabalho</strong>
                        <span>Documentos necessários para trabalhar.</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </a>

                <!-- Card: Saúde -->
                <a href="detalhes_saude.php" class="nav-card">
                    <div class="card-icon-circle red">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <div class="card-info">
                        <strong>Saúde</strong>
                        <span>Acesso ao SUS e serviços de saúde.</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </a>

                <!-- Card: Educação -->
                <a href="detalhes_educacao.php" class="nav-card">
                    <div class="card-icon-circle yellow">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="card-info">
                        <strong>Educação</strong>
                        <span>Matrícula em escolas, diplomas e certificações.</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </a>

            </div>
        </div>
        <nav class="bottom-nav">
            <a href="mainPage.php" class="nav-item">
                <i class="fa-solid fa-house"></i>
                <span>Início</span>
            </a>
            <a href="documentos.php" class="nav-item active">
                <i class="fa-solid fa-file-lines"></i>
                <span>Documentos</span>
            </a>
            <a href="agenda.php" class="nav-item">
                <i class="fa-solid fa-calendar"></i>
                <span>Agenda</span>
            </a>
            <a href="dicas.php" class="nav-item">
                <i class="fa-solid fa-star"></i>
                <span>Dicas</span>
            </a>
            <a href="perfil.php" class="nav-item">
                <i class="fa-solid fa-user"></i>
                <span>Perfil</span>
            </a>
        </nav>
        </main>
        <script src="/TCC/registrar-sw.js"></script>
    </body>
</html>
