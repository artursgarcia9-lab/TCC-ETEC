<?php

require_once "../Services/usuarioService.php";

$service = new UsuarioService();
$usuarios = $service->listar();

foreach ($usuarios as $u) {
    echo $u['nome'] . " - " . $u['email'] . "<br>";
}

?>