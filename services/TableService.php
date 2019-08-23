<?php
declare(strict_types=1);

namespace Services;

use Database\Database;
use Exception;

class TableService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getRows(string $table, ?int $id): array
    {
        $condition = '';
        if($id !== null)
            $condition = " WHERE id = $id";

        $this->db->filterString($table);

        try {
            $isAllowToRead = self::isTableAllowToRead($table);
        }catch(Exception $e) {
            throw $e;
        }

        if(!$isAllowToRead)
            throw new Exception('Из этой таблицы читать запрещено');

        if(!$res = $this->db->query("SELECT * 
                                 FROM $table
                                 $condition"))
            throw new Exception('Ошибка sql');

        $rows = [];

        while($row = $res->fetch_object()) {
            $rows[] = $row;
        };

        return $rows;
    }

    private function isTableAllowToRead(string $table): bool
    {
        if(!$res = $this->db->query("SELECT id 
                                     FROM allow_to_read_tables 
                                     WHERE `table` = '$table'"))
            throw new Exception('Ошибка sql');

        return $res->num_rows === 0 ? false: true;
    }
}