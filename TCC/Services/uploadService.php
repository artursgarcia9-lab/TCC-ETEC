<?php
class UploadService {
    private $pastaDestino;
    private $extensoesPermitidas = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];

    public function __construct() {
        $this->pastaDestino = __DIR__ . '/../Uploads/';
        if (!is_dir($this->pastaDestino)) {
            mkdir($this->pastaDestino, 0777, true);
        }
    }

    public function salvar($arquivo) {
        if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Erro ao enviar arquivo.');
        }

        $nomeOriginal = basename($arquivo['name']);
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if (!in_array($extensao, $this->extensoesPermitidas)) {
            throw new Exception('Tipo de arquivo não permitido.');
        }

        $nomeSeguro = uniqid('arquivo_', true) . '.' . $extensao;
        $destino = $this->pastaDestino . $nomeSeguro;

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            throw new Exception('Não foi possível salvar o arquivo.');
        }

        return $nomeSeguro;
    }
}
