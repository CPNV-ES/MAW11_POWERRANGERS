<?php

namespace App;

class Request extends HTTP
{
    public function __construct(string $path, string $statusCode)
    {
        parent::__construct($path, $statusCode);
    }
}
