<?php
session_start();


// Inicia o histórico se não existir
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [
        ['type' => 'bot', 'text' => 'Olá! Eu sou o Assistente EasyMigra. Como posso ajudar você hoje?', 'time' => date('H:i')]
    ];
    
}

// Lógica de envio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensagem'])) {
    $userMsg = htmlspecialchars($_POST['mensagem']);
    
    // Adiciona mensagem do usuário
    $_SESSION['chat_history'][] = ['type' => 'user', 'text' => $userMsg, 'time' => date('H:i')];
    
    // Simulação de lógica do Bot (IA)
    $botReply = "Ainda estou aprendendo sobre isso. Pode detalhar melhor?";
    if (stripos($userMsg, 'rne') !== false) {
        $botReply = "Você precisa do passaporte, visto válido, comprovante de endereço e formulário da Polícia Federal.";
    }

    $_SESSION['chat_history'][] = ['type' => 'bot', 'text' => $botReply, 'time' => date('H:i')];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once '../Config/header.php'; ?>
        <title>Chat de Apoio - EasyMigra</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../css/style_dashboard.css">
        <style>
        body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} 
        main{max-width:900px;margin:30px auto;background:white;padding:25px;border-radius:10px} 
        table{width:100%;border-collapse:collapse} th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} 
        input,button{padding:10px;margin:5px 0} a{color:#4e73df}
        </style>
    </head>
    <body>
        <div class="chat-window">
            <header class="app-header-chat" style="background-color: #224abe; padding: 15px; color: white; display: flex; align-items: center; gap: 15px;">
            <a href="mainPage.php" style="color: white; text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
                <div style="flex-grow: 1; text-align: center;"><strong>Chat de Apoio</strong></div>
                <i class="fa-solid fa-ellipsis"></i>
            </header>
        <div class="chat-body" id="chatBody">
        <?php foreach ($_SESSION['chat_history'] as $msg): ?>
        <div class="message-wrapper <?= $msg['type'] === 'bot' ? 'bot-wrapper' : 'user-wrapper' ?>" style="display: flex; flex-direction: column;">
            
            <div class="message <?= $msg['type'] === 'bot' ? 'bot-message' : 'user-message' ?>">
                
                <?php if ($msg['type'] === 'bot'): ?>
                    <i class="fa-solid fa-robot" style="margin-right: 8px; color: #224abe;"></i>
                <?php endif; ?>

                <?= $msg['text'] ?>

                <div style="font-size: 10px; opacity: 0.6; text-align: right; margin-top: 5px;">
                    <?= $msg['time'] ?>
                </div>
            </div>
            
        </div>
        <?php endforeach; ?>
        </div>
            <form class="chat-footer" method="POST">
                <input type="text" name="mensagem" class="chat-input" placeholder="Digite sua mensagem..." required autocomplete="off">
                <button type="submit" class="send-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
        <script>
            // Scroll automático para a última mensagem ao carregar
            const chatBody = document.getElementById('chatBody');
            chatBody.scrollTop = chatBody.scrollHeight;
        </script>

        <nav class="bottom-nav">
            <a href="mainPage.php" class="nav-item"><i class="fa-solid fa-house"></i><span>Início</span></a>
            <a href="documentos.php" class="nav-item"><i class="fa-solid fa-file-lines"></i><span>Documentos</span></a>
            <a href="agenda.php" class="nav-item active"><i class="fa-solid fa-comment"></i><span>Chat</span></a>
            <a href="dicas.php" class="nav-item"><i class="fa-solid fa-star"></i><span>Dicas</span></a>
            <a href="perfil.php" class="nav-item"><i class="fa-solid fa-user"></i><span>Perfil</span></a>
        </nav>
        </main>
        <script src="/TCC/registrar-sw.js"></script>
    </body>
</html>

