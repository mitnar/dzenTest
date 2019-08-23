<?php
declare (strict_types=1);

namespace Services;

use Database\Database;
use Exception;

class SessionService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function subscribe(int $sessionId, string $userEmail)
    {
        $userEmail = $this->db->filterString($userEmail);

        if(!$resUser = $this->db->query("SELECT name 
                                         FROM participant
                                         WHERE Email = '$userEmail'"))
            throw new Exception('Ошибка sql');

        if($resUser->num_rows === 0)
            throw new Exception('Пользователь не найден');

        try {
            if(self::isSessionFull($sessionId))
                throw new Exception('Извините, все места заняты');
        } catch(Exception $e) {
            throw $e;
        }

        if($user = $resUser->fetch_object())
            if(!$this->db->query("INSERT INTO speaker(`Name`, `SessionId`)
                              VALUES('{$user->name}', $sessionId)"))
                throw new Exception('Ошибка sql');
    }

    private function isSessionFull(int $sessionId): bool
    {
        if(!$res = $this->db->query("SELECT COUNT(sp.id) as usersCount, s.numberOfParticipants
                                     FROM speaker sp
                                     INNER JOIN session s ON s.ID = sp.SessionId
                                     WHERE `sessionId` = $sessionId"))
            throw new Exception('Ошибка sql');
        $row = $res->fetch_assoc();

        return $row['usersCount'] === $row['numberOfParticipants'];
    }
}