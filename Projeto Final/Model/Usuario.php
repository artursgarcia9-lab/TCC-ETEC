<?php

class Usuario{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha; //Armazenada com hash (campo no BD alterado de 45 para 255 caracteres)
    
    //Getters e Setters

    //ID gerado pelo banco
    public function setID($id)
    {
        $this->id = $id;
    }
    
    public function getID()
    {
        return $this->id;
    }
    
    //Nome 
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    //CPF
    public function setCPF($cpf)
    {
        $this->cpf = $cpf;
    }
    
    public function getCPF()
    {
        return $this->cpf;
    }

    //Email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    //Data de nascimento
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

     //Senha em texto puro, será convertida em hash antes de salvar
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getSenha()
    {
        return $this->senha;
    }


    //Métodos

    //Insere um novo usuário na tabela Usuario
    public function inserirBD()
    {
        require_once 'ConexaoBD.php';

        try {
            $conn = ConexaoBD::conectar();

            $sql = "INSERT INTO usuario (nome, cpf, email, dataNascimento, senha) 
                    VALUES (:nome, :cpf, :email, :dataNascimento, :senha)";

            $stmt = $conn->prepare($sql);

            //Gera o hash da senha antes de salvar (nunca salva em texto puro)
            $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);

             //Vincula os valores aos parâmetros nomeados da query
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':dataNascimento', $this->dataNascimento);
            $stmt->bindValue(':senha', $senhaHash);

            $stmt->execute();

             //Guarda o ID gerado pelo banco após a inserção
            $this->id = $conn->lastInsertId();

            return true;

        } catch (PDOException $e) {
            echo "Erro ao inserir: " . $e->getMessage();
            return false;
        }
    }

    //Busca um usuário pelo CPF e preenche os atributos da instância
    public function carregarUsuario($cpf)
    {
        require_once 'ConexaoBD.php';

        try {
            $conn = ConexaoBD::conectar();

            //LIMIT 1 garante que apenas um registro seja retornado
            $sql = "SELECT * FROM usuario WHERE cpf = :cpf LIMIT 1";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();

            //Retorna o resultado como objeto para acesso via ->propriedade
            $r = $stmt->fetch(PDO::FETCH_OBJ);

            if ($r) {
                //Preenche os atributos com os dados vindos do banco
                $this->id = $r->idusuario;
                $this->nome = $r->nome;
                $this->email = $r->email;
                $this->cpf = $r->cpf;
                $this->dataNascimento = $r->dataNascimento;
                $this->senha = $r->senha;

                return true;
            } else {
                return false; //Usuário não encontrado
            }

        } catch (PDOException $e) {
            echo "Erro ao carregar usuário: " . $e->getMessage();
            return false;
        }
    }

     //Atualiza os dados cadastrais do usuário (não atualiza a senha aqui)
    public function atualizarBD()
    {
        require_once 'ConexaoBD.php';

        try {
            $conn = ConexaoBD::conectar();

            $sql = "UPDATE usuario SET 
                        nome = :nome,
                        cpf = :cpf,
                        dataNascimento = :dataNascimento,
                        email = :email
                    WHERE idusuario = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':dataNascimento', $this->dataNascimento);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            return false;
        }
    }
}