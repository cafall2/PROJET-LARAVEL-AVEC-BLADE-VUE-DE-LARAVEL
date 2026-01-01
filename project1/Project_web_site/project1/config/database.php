<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecommerce_site');

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->conn->connect_error) {
                throw new Exception("Erreur de connexion: " . $this->conn->connect_error);
            }

            $this->conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }
}

function getDB() {
    return Database::getInstance()->getConnection();
}
?>
