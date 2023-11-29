<?php

namespace App;

class HandlerResponse extends HTTP
{
    public function __construct(string $path, string $statusCode)
    {
        parent::__construct($path, $statusCode);
    }
}
