<?php

namespace App;

use App\HTTP;

class HandlerResponse extends HTTP
{
    public function __construct(array $method, string $statusCode)
    {
        parent::__construct($method, $statusCode);
    }
}
