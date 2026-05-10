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
// Formatar eventos para o FullCalendar
$eventos_formatados = [];
foreach ($eventos as $evento) {
    $eventos_formatados[] = [
       'id'    => $evento['id_agenda'],
       'title' => $evento['descricao'],
        'start' => $evento['data_evento'], // Deve estar no formato YYYY-MM-DD
        'color' => '#f37021'
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-br"><head><script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<meta charset="UTF-8"><title>Agenda - EasyMigra</title>
<link rel="stylesheet" href="../css/style_dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Ajuste para o calendário caber na tela mobile */
    #calendar {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 10px;
        border-radius: 8px;
    }
    .fc-toolbar-title { font-size: 1.2em !important; color: #333; }
    .fc-button-primary { background-color: #f37021 !important; border-color: #f37021 !important; }
body{font-family:Arial,sans-serif;background:#f4f6f9;margin:0} main{max-width:800px;margin:30px auto;background:white;padding:25px;border-radius:10px} input,button{padding:10px;margin:5px 0} table{width:100%;border-collapse:collapse} th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left} .danger{background:#dc3545;color:white;border:0;border-radius:4px}
</style></head>
<body><!-- Header Laranja conforme Imagem -->
<header class="app-header-agenda">
     <a href="mainPage.php" style="color: white;"><i class="fa-solid fa-arrow-left"></i></a>
    <h2>Agenda</h2>
    <i class="fa-solid fa-magnifying-glass"></i>
</header>

<main class="agenda-page">
    <section class="calendar-container">
    <div id='calendar'></div>
</section>
   
    <!-- Lista de Compromissos -->
    <section class="appointments-section">
        <h3>Próximos compromissos</h3>
        
        <div class="appointment-card border-orange">
            <div class="app-info">
                <span class="dot orange-dot"></span>
                <div class="text-group">
                    <strong>Vencimento do RNM</strong>
                    <p>Documento de residência</p>
                </div>
            </div>
            <span class="app-date">05/05/2026</span>
        </div>

        <div class="appointment-card border-green">
            <div class="app-info">
                <span class="dot green-dot"></span>
                <div class="text-group">
                    <strong>Agendamento - Polícia Federal</strong>
                    <p>Renovação de visto</p>
                </div>
            </div>
            <span class="app-date">12/05/2026</span>
        </div>
    </section>
</main>

<!-- Barra Inferior -->
<nav class="bottom-nav">
    <a href="mainPage.php" class="nav-item">
        <i class="fa-solid fa-house"></i>
        <span>Início</span>
    </a>
    <a href="documentos.php" class="nav-item">
        <i class="fa-solid fa-file-lines"></i>
        <span>Documentos</span>
    </a>
    <a href="agenda.php" class="nav-item active-agenda">
        <i class="fa-solid fa-calendar-days"></i>
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
<main>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        },
        // Pegando os dados que o PHP preparou
        events: <?php echo json_encode($eventos_formatados); ?>,
        
        // Exemplo: Criar evento ao clicar na data
        dateClick: function(info) {
            let desc = prompt('Nova atividade para ' + info.dateStr + ':');
            if (desc) {
                // Aqui você pode disparar um formulário oculto para salvar
                alert('Salvar no banco: ' + desc);
            }
        },
        
        // Exemplo: Excluir ou ver detalhes ao clicar no evento
        eventClick: function(info) {
            if(confirm("Deseja excluir este compromisso?")) {
                // Enviar comando de exclusão via POST ou Redirect
                window.location.href = "agenda.php?excluir_id=" + info.event.id;
            }
        }
    });
    calendar.render();
});
</script>
</body></html>
