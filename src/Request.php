<?php

namespace model\class;

use HTTP;

require_once dirname(__FILE__).'/HTTP.php';

class Request extends HTTP
{
    public function __construct(string $path, string $statusCode)
    {
        parent::__construct($path, $statusCode);
    }
}
