<?php

namespace model\class;

use HTTP;

require_once dirname(__FILE__).'/HTTP.php';

class RouterResponse extends HTTP
{
    private array $variables;
    public function __construct(string $path, string $statusCode, array $variables = [])
    {
        parent::__construct($path, $statusCode);
        $this->variables = $variables;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }
}