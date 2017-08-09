<?php

namespace ParkimeterAffiliates\Domain\Model;

final class ErrorBag
{

    private $errors = [];
    private $code;
    private $message;

    public function __construct($message, $code)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function add($key, $value)
    {
        $this->errors[] = new Error($key, $value);
    }

    public function errors(): array
    {
        return$this->errors;
    }

    public function code(): int
    {
        return $this->code;
    }

    public function message(): string
    {
        return $this->message;
    }
}
