<?php

namespace Responses;

class SuccessfulResponse extends Response
{
    public function __construct($payload, string $message)
    {
        parent::__construct($payload, $message);
        $this->status = 'ok';
    }
}