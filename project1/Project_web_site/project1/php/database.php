<?php

class Database {
    private static $instance = null;
    private $connection;

    private $host;
    private $username;
    private $password;
    private $database;

    private function __construct() {
        if (file_exists(__DIR__ . '/../.env.production')) {
            $this->loadEnv(__DIR__ . '/../.env.production');
        } elseif (getenv('DB_HOST')) {
            $this->host = getenv('DB_HOST');
            $this->username = getenv('DB_USER');
            $this->password = getenv('DB_PASS');
            $this->database = getenv('DB_NAME');
        } else {
            $this->host = defined('DB_HOST') ? DB_HOST : 'localhost';
            $this->username = defined('DB_USER') ? DB_USER : 'root';
            $this->password = defined('DB_PASS') ? DB_PASS : '';
            $this->database = defined('DB_NAME') ? DB_NAME : 'ecommerce_site';
        }

        $this->connect();
    }

    private function loadEnv($path) {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            switch ($name) {
                case 'DB_HOST':
                    $this->host = $value;
                    break;
                case 'DB_USER':
                    $this->username = $value;
                    break;
                case 'DB_PASS':
                    $this->password = $value;
                    break;
                case 'DB_NAME':
                    $this->database = $value;
                    break;
            }
        }
    }

    private function connect() {
        try {
            $this->connection = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->database
            );

            if ($this->connection->connect_error) {
                throw new Exception('Erreur de connexion: ' . $this->connection->connect_error);
            }

            $this->connection->set_charset("utf8mb4");

        } catch (Exception $e) {
            error_log('Database connection error: ' . $e->getMessage());

            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Erreur de connexion à la base de données'
            ]);
            exit();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        if (!$this->connection || !$this->connection->ping()) {
            $this->connect();
        }
        return $this->connection;
    }

    public function query($sql) {
        return $this->getConnection()->query($sql);
    }

    public function prepare($sql) {
        return $this->getConnection()->prepare($sql);
    }

    public function escape($value) {
        return $this->getConnection()->real_escape_string($value);
    }

    public function lastInsertId() {
        return $this->getConnection()->insert_id;
    }

    public function beginTransaction() {
        return $this->getConnection()->begin_transaction();
    }

    public function commit() {
        return $this->getConnection()->commit();
    }

    public function rollback() {
        return $this->getConnection()->rollback();
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    private function __clone() {}

    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

function getDBConnection() {
    return Database::getInstance()->getConnection();
}
?>
