<?php

namespace Responses;

use JsonSerializable;

abstract class Response implements JsonSerializable
{
    protected $status;
    protected $payload;
    protected $message;

    protected function __construct($payload, string $message)
    {
        $this->payload = $payload;
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}