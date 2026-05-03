<?php

require_once __DIR__ . "/../Config/conexao.php";
require_once __DIR__ . "/../Models/usuario.php";

class UsuarioService {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    // CADASTRAR USUÁRIO
    public function cadastrar(Usuario $usuario) {

        try {

            $sql = "INSERT INTO Usuario 
            (nome, status_residencia, apelido, email, idioma, pais_origem, senha)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                $usuario->getNome(),
                $usuario->getStatusResidencia(),
                $usuario->getApelido(),
                $usuario->getEmail(),
                $usuario->getIdioma(),
                $usuario->getPaisOrigem(),
                $usuario->getSenha() // sem hash aqui
            ]);

            return $this->pdo->lastInsertId();

        } catch (Exception $e) {
            die("Erro ao cadastrar usuário: " . $e->getMessage());
        }
    }

    // LISTAR USUÁRIOS
    public function listar() {

        try {

            $stmt = $this->pdo->query("SELECT * FROM Usuario");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            die("Erro ao listar usuários: " . $e->getMessage());
        }
    }

    // LOGIN
    public function login($email, $senha) {

        try {

            $sql = "SELECT u.*, a.nivel_acesso, a.cargo
                    FROM Usuario u
                    LEFT JOIN Administrador a 
                    ON u.id_usuario = a.fk_Usuario_id_usuario
                    WHERE u.email = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$email]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return $usuario;
            }

            return false;

        } catch (Exception $e) {
            die("Erro no login: " . $e->getMessage());
        }
    }

    // TORNAR ADMIN
    public function tornarAdmin($id_usuario, $nivel, $cargo) {

        try {

            $sql = "INSERT INTO Administrador 
            (nivel_acesso, cargo, fk_Usuario_id_usuario)
            VALUES (?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([$nivel, $cargo, $id_usuario]);

        } catch (Exception $e) {
            die("Erro ao tornar administrador: " . $e->getMessage());
        }
    }
}