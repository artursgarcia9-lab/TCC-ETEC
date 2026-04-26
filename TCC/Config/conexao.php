<?php

class Conexao {

    private static $host = "localhost";
    private static $dbname = "bd_tcc";
    private static $user = "root";
    private static $pass = "";

    private static $instance;

    public static function conectar() {

        if (!isset(self::$instance)) {

            try {
                self::$instance = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                    self::$user,
                    self::$pass
                );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}