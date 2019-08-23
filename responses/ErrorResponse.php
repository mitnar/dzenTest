<?php

namespace Responses;
use stdClass;

class ErrorResponse extends Response
{
    public function __construct(string $message)
    {
        parent::__construct(new stdClass(), $message);
        $this->status = 'error';
    }
}