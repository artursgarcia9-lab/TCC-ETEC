<?php

class Usuario {

    private $id_usuario;
    protected $nome;
    protected $status_residencia;
    protected $apelido;
    protected $email;
    protected $idioma;
    protected $pais_origem;
    protected $senha;

    public function __construct($nome, $email, $senha) {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
    }

    // GETTERS
    public function getId() {
        return $this->id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdioma() {
        return $this->idioma;
    }

    public function getStatusResidencia() {
        return $this->status_residencia;
    }

    public function getApelido() {
        return $this->apelido;
    }

    public function getPaisOrigem() {
        return $this->pais_origem;
    }

    public function getSenha() {
        return $this->senha;
    }

    // SETTERS COM VALIDAÇÃO
    public function setNome($nome) {
        if (strlen($nome) < 3) {
            throw new Exception("Nome inválido.");
        }
        $this->nome = $nome;
    }

    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido.");
        }
        $this->email = $email;
    }

    public function setSenha($senha) {
        if (strlen($senha) < 4) {
            throw new Exception("Senha muito curta.");
        }
        // Segurança básica
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setStatusResidencia($status) {
    $this->status_residencia = $status;
    }

    public function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    public function setIdioma($idioma) {
        $this->idioma = $idioma;
    }

    public function setPaisOrigem($pais) {
        $this->pais_origem = $pais;
    }

    // MÉTODOS DO SEU DOMÍNIO (mantidos ✔)
    protected function consultarDocumentos() {
        return "Consultando documentos...";
    }

    protected function traduzirConteudo($texto) {
        return "Traduzindo: " . $texto;
    }

    protected function localizarOrgaos() {
        return "Localizando órgãos próximos...";
    }

    protected function cadastrarAgenda() {
        return "Evento cadastrado na agenda.";
    }

    protected function exibirUsuario() {
        return "Usuário: {$this->nome} ({$this->email}) - Idioma: {$this->idioma}";
    }
}