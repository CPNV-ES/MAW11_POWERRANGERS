<?php

namespace App;

class Request
{
    private string $path;
    private string $method;

    public function __construct(string $path, string $method)
    {
        $this->path = $path;
        $this->method = $method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
