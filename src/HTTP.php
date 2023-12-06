<?php

namespace App;

abstract class HTTP
{
    private array $method;
    private string $statusCode;

    public function __construct(array $method, string $statusCode)
    {
        $this->method = $method;
        $this->statusCode = $statusCode;
    }

    public function getMethod(): array
    {
        return $this->method;
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }
}
