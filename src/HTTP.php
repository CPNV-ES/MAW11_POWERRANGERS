<?php

namespace App;

abstract class HTTP
{
    private string $path;
    private string $statusCode;

    public function __construct(string $path, string $statusCode)
    {
        $this->path = $path;
        $this->statusCode = $statusCode;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }
}
