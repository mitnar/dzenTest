<?php
declare(strict_types=1);

namespace Controllers;

use Services\SessionService;
use Responses\ErrorResponse;
use Responses\SuccessfulResponse;
use Exception;
use stdClass;

class SessionController
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function subscribe(): string
    {
        if(!isset($_POST['sessionId']) || !isset($_POST['userEmail']) || !is_numeric($_POST['sessionId']))
            return json_encode(new ErrorResponse('Неверные входные данные'), JSON_UNESCAPED_UNICODE);

        try {
            $this->sessionService->subscribe((int)$_POST['sessionId'], $_POST['userEmail']);
        } catch(Exception $e) {
            return json_encode(new ErrorResponse($e->getMessage()), JSON_UNESCAPED_UNICODE);
        }

        return json_encode(new SuccessfulResponse(new stdClass(), 'Спасибо, вы успешно записаны'),
            JSON_UNESCAPED_UNICODE);
    }
}