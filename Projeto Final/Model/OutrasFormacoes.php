<?php

class OutrasFormacoes {

    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    //Getters e Setters

    // ID
    public function setID($id) {
        $this->id = $id;
    }

    public function getID() {
        return $this->id;
    }

    //ID do Usuário, chave estrangeira
    public function setIdUsuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getIdUsuario() {
        return $this->idusuario;
    }

    //Data de Início
    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getInicio() {
        return $this->inicio;
    }

    //Data de Fim, pode ser nula (Ainda atuando)
    public function setFim($fim) {
        $this->fim = $fim;
    }

    public function getFim() {
        return $this->fim;
    }

    // descricao
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    
    //Métodos

    //Insere uma nova formação na tabela
    public function inserirBD() {
        require_once 'ConexaoBD.php';

        try {
            $conn = ConexaoBD::conectar();

            $sql = "INSERT INTO outrasformacoes 
                    (idusuario, inicio, fim, descricao)
                    VALUES (:idusuario, :inicio, :fim, :descricao)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':idusuario', $this->idusuario, PDO::PARAM_INT);
            $stmt->bindValue(':inicio', $this->inicio);
            $stmt->bindValue(':fim', $this->fim ?: null); //Salva NULL se fim não for informado
            $stmt->bindValue(':descricao', $this->descricao);

            $stmt->execute();

             //Guarda o ID gerado pelo banco após a inserção
            $this->id = $conn->lastInsertId();

            return true;

        } catch (PDOException $e) {
            echo "Erro ao inserir outras formações: " . $e->getMessage();
            return false;
        }
    }

    // Remove uma formação pelo seu ID
    public function excluirBD($id) {
        require_once 'ConexaoBD.php';

        try {
            $conn = ConexaoBD::conectar();

            $sql = "DELETE FROM outrasformacoes 
                    WHERE idoutrasformacoes = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "Erro ao excluir outras formações: " . $e->getMessage();
            return false;
        }
    }

    //Retorna todas as outras formações de um usuário específico
    public function listaFormacoes($idusuario) {
        require_once 'ConexaoBD.php';

        try {
            $conn = ConexaoBD::conectar();

            $sql = "SELECT * FROM outrasformacoes 
                    WHERE idusuario = :idusuario";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idusuario', $idusuario, PDO::PARAM_INT);

            $stmt->execute();

            //Retorna um array associativo com todos os registros encontrados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erro ao listar outras formações: " . $e->getMessage();
            return []; //Retorna array vazio em caso de erro
        }
    }
}