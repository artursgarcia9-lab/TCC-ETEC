<?php
session_start();

// limpa tudo
session_unset();
session_destroy();

// redireciona
header("Location: index.php");
exit;
?>