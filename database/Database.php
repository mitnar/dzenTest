<?php
namespace Database;

use mysqli;
require_once 'db_cfg.php'; // подход исключительно для тестового задания

class Database
{
    private static $m_pInstance;
    private $mysqli;

    private function __construct()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_NAME);
        if ($this->mysqli->connect_errno) {
            die("Не удалось подключиться к MySQL: " . $this->mysqli->connect_error);
        }
    }

    public static function getInstance(): object
    {
        if (!self::$m_pInstance) {
            self::$m_pInstance = new Database();
        }
        return self::$m_pInstance;
    }

    public function query(string $query)
    {
        return $this->mysqli->query($query);
    }

    public function filterString(string $string)
    {
        $string = strip_tags($string);
        $string = htmlspecialchars($string);
        $string = $this->mysqli->real_escape_string($string);

        return $string;
    }
}
