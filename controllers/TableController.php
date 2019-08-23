<?php
declare (strict_types=1);

namespace Controllers;

use Responses\ErrorResponse;
use Responses\SuccessfulResponse;
use Services\TableService;
use Exception;

class TableController {

    private $tableService;

    public function __construct()
    {
        $this->tableService = new TableService();
    }

    public function getRows(): string
    {
        if(!isset($_POST['table']) || !isset($_POST['id']))
            return json_encode(new ErrorResponse('Неверные входные данные'), JSON_UNESCAPED_UNICODE);

        $table = $_POST['table'];
        $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

        try {
            $result = $this->tableService->getRows($table, $id);
        } catch(Exception $e) {
            return json_encode(new ErrorResponse($e->getMessage()), JSON_UNESCAPED_UNICODE);
        }

        return json_encode(new SuccessfulResponse($result, ''),
            JSON_UNESCAPED_UNICODE);
    }
}














