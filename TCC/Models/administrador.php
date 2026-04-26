<?php

require_once "usuario.php";

class Administrador extends Usuario {
    
    // Atributos específicos
    private $nivel_acesso;
    private $cargo;

    // Construtor
    public function __construct(
        $id, $nome, $status, $apelido, $email, $idioma, $pais, $senha,
        $nivel_acesso, $cargo
    ) {
        // Chama o construtor da classe pai
        parent::__construct($id, $nome, $status, $apelido, $email, $idioma, $pais, $senha);

        $this->nivel_acesso = $nivel_acesso;
        $this->cargo = $cargo;
    }

    // Métodos GET
    public function getNivelAcesso() {
        return $this->nivel_acesso;
    }

    public function getCargo() {
        return $this->cargo;
    }

    // Métodos específicos do administrador
    public function atualizarConteudo() {
        return "Conteúdo atualizado pelo administrador.";
    }

    public function consultarFontes() {
        return "Consultando fontes oficiais...";
    }

    // Sobrescrita (opcional, mas didaticamente interessante)
    public function exibirUsuario() {
        return parent::exibirUsuario() . " | Cargo: {$this->cargo} | Nível: {$this->nivel_acesso}";
    }
}

?>