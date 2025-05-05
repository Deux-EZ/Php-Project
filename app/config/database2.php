<?php

class Database2 {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $this->connection = new mysqli(
            Config::get('DB2_HOST'),
            Config::get('DB2_USER'),
            Config::get('DB2_PASS'),
            Config::get('DB2_NAME'),
            Config::get('DB2_PORT')
        );
        if ($this->connection->connect_error) {
            throw new Exception("Error de conexión DB2: " . $this->connection->connect_error);
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