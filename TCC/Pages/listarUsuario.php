<?php

require_once "../Services/UsuarioService.php";

$service = new UsuarioService();
$usuarios = $service->listar();

foreach ($usuarios as $u) {
    echo $u['nome'] . " - " . $u['email'] . "<br>";
}

?>