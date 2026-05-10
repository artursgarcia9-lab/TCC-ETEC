<?php

class ConexaoBD {

    // Dados de configuração do banco
    private static $host = "localhost";
    private static $dbname = "projeto_final";
    private static $user = "root";
    private static $pass = "";

    // Armazena a única instância da conexão (padrão Singleton)
    private static $instance;

    // Retorna a conexão existente ou cria uma nova caso ainda não exista
    public static function conectar() {

        if (!isset(self::$instance)) {

            try {
                // Cria a conexão PDO com charset UTF-8 para suportar acentos
                self::$instance = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4",
                    self::$user,
                    self::$pass
                );

                // Configura o PDO para lançar exceções em caso de erro
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Encerra a execução e exibe a mensagem de erro de conexão
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}