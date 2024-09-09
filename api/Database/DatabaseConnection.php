<?php
namespace Api\Database;

use PDO;
class DatabaseConnection {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=schoolbook;charset=utf8mb4', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
