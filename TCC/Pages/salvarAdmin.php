<?php

require_once "../Config/auth.php";
require_once "../Services/usuarioService.php";

$id_usuario = $_POST['id_usuario'];
$nivel = $_POST['nivel'];
$cargo = $_POST['cargo'];

$service = new UsuarioService();

if ($service->tornarAdmin($id_usuario, $nivel, $cargo)) {
    echo "Administrador criado com sucesso!";
} else {
    echo "Erro ao criar administrador.";
}

?>