<?php

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $host = 'mysql';
        $dbname = 'sql_analyzer';
        $username = 'user';
        $password = 'password';
        
        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die(json_encode([
                'error' => true,
                'message' => 'Erro na conexão com o banco de dados',
                'details' => $e->getMessage()
            ]));
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}