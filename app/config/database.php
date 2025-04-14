<?php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new mysqli(
                Config::get('DB_HOST'),
                Config::get('DB_USER'),
                Config::get('DB_PASS'),
                Config::get('DB_NAME'),
                Config::get('DB_PORT')
            );

            if ($this->connection->connect_error) {
                throw new Exception("Error de conexión: " . $this->connection->connect_error);
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}