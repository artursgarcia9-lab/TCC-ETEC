<?php
require_once '../Config/auth.php';
require_once '../Services/dicaService.php';

$service = new DicaService();
$id_usuario = $_SESSION['usuario']['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_usuario) {
    $texto = trim($_POST['texto'] ?? '');
    if ($texto !== '') {
        $service->cadastrar($id_usuario, $texto);
    }
    header('Location: dicas.php'); 
    exit;
}

$dicas = $service->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicas - EasyMigra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #224abe;
            --light-blue: #eef2ff;
            --text-dark: #333;
            --white: #ffffff;
            --green-dicas: #16a085;
        }
        * { box-sizing: border-box; }
        body {
            background-color: #f8f9fc;
            margin: 0;
            padding-bottom: 80px; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
        }

        /* Header */
        .app-header-dicas {
            background-color: var(--green-dicas);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        /* Tabs */
        .dicas-tabs {
            display: flex;
            background: white;
            padding: 10px 20px;
            gap: 20px;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 50px;
            z-index: 800;
        }
        .tab { font-size: 14px; color: #888; padding-bottom: 5px; cursor: pointer; }
        .tab.active { color: var(--green-dicas); border-bottom: 2px solid var(--green-dicas); font-weight: bold; }

        /* Feed */
        .dica-card {
            background: white;
            margin: 15px;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .dica-header { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .avatar-placeholder {
            width: 40px; height: 40px; background-color: var(--green-dicas);
            color: white; border-radius: 50%; display: flex;
            align-items: center; justify-content: center; font-weight: bold;
        }
        .user-meta strong { display: block; font-size: 14px; }
        .user-meta span { font-size: 11px; color: #999; }
        .dica-text { font-size: 14px; color: #555; line-height: 1.5; }

        /* Botão Flutuante */
        .btn-compartilhar {
            position: fixed; bottom: 90px; right: 20px;
            background: var(--green-dicas); color: white;
            border: none; padding: 12px 20px; border-radius: 30px;
            font-weight: bold; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 999; cursor: pointer;
        }

        /* Modal */
        .modal-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); display: none;
            justify-content: center; align-items: center; z-index: 2000;
        }
        .modal-content {
            background: var(--white); padding: 20px; border-radius: 15px;
            width: 90%; max-width: 400px;
        }
        .modal-content textarea {
            width: 100%; height: 120px; margin: 15px 0; padding: 10px;
            border: 1px solid #ddd; border-radius: 8px; resize: none;
        }
        .modal-buttons { display: flex; justify-content: flex-end; gap: 10px; }
        .btn-submit { background: var(--green-dicas); color: white; border: none; padding: 8px 20px; border-radius: 5px; font-weight: bold; cursor: pointer; }

        /* Nav Inferior */
        .bottom-nav {
            position: fixed; bottom: 0; width: 100%; background: var(--white);
            display: flex; justify-content: space-around; padding: 12px 0;
            border-top: 1px solid #eee; z-index: 1000;
        }
        .nav-item { text-decoration: none; color: #999; display: flex; flex-direction: column; align-items: center; font-size: 10px; gap: 4px; }
        .nav-item.active { color: var(--green-dicas); }
    </style>
</head>
<body class="dicas-page-active">

<header class="app-header-dicas">
     <a href="mainPage.php" style="color: white;"><i class="fa-solid fa-arrow-left"></i></a>
    <h2>Dicas da Comunidade</h2>
    <i class="fa-solid fa-magnifying-glass"></i>
</header>

<nav class="dicas-tabs">
    <span class="tab active">Todas</span>
    <span class="tab">Trabalho</span>
    <span class="tab">Moradia</span>
    <span class="tab">Saúde</span>
</nav>

<main>
    <div class="feed-container">
        <?php if (empty($dicas)): ?>
            <p style="text-align: center; color: #999; margin-top: 40px;">Seja o primeiro a compartilhar!</p>
        <?php else: ?>
            <?php foreach($dicas as $d): ?>
                <div class="dica-card">
                    <div class="dica-header">
                        <div class="avatar-placeholder"><?= strtoupper(substr($d['autor'] ?? 'U', 0, 1)); ?></div>
                        <div class="user-meta">
                            <strong><?= htmlspecialchars($d['autor'] ?? 'Usuário'); ?></strong>
                            <span><?= date('d/m/Y', strtotime($d['data_publicacao'])); ?></span>
                        </div>
                    </div>
                    <p class="dica-text"><?= htmlspecialchars($d['texto']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <button class="btn-compartilhar" onclick="document.getElementById('modalDica').style.display='flex'">
       <i class="fa-solid fa-plus" ></i> Compartilhar dica
    </button>

</main>

<nav class="bottom-nav">
    <a href="mainPage.php" class="nav-item"><i class="fa-solid fa-house"></i><span>Início</span></a>
    <a href="documentos.php" class="nav-item"><i class="fa-solid fa-file-lines"></i><span>Documentos</span></a>
    <a href="agenda.php" class="nav-item"><i class="fa-solid fa-calendar-days"></i><span>Agenda</span></a>
    <a href="dicas.php" class="nav-item active"><i class="fa-solid fa-star"></i><span>Dicas</span></a>
    <a href="perfil.php" class="nav-item"><i class="fa-solid fa-user"></i><span>Perfil</span></a>
</nav>
<div id="modalDica" class="modal-container">
    <div class="modal-content">
        <h3>Nova Dica</h3>
        <form method="POST">
            <textarea name="texto" placeholder="No que você está pensando?" required></textarea>
            <div class="modal-buttons">
                <button type="button" onclick="document.getElementById('modalDica').style.display='none'">Cancelar</button>
                <button type="submit" class="btn-submit">Publicar</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.onclick = function(event) {
        const modal = document.getElementById('modalDica');
        if (event.target == modal) modal.style.display = "none";
    }
</script>
</body>
</html>