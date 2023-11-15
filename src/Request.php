<?php

namespace model\class;

use HTTP;

require_once SOURCE_DIR.'/HTTP.php';

class Request extends HTTP
{
    public function __construct(string $path, string $statusCode)
    {
        parent::__construct($path, $statusCode);
    }
}
