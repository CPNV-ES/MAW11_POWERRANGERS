<?php

namespace App;

class RouterResponse extends HTTP
{
    private array $variables;
    public function __construct(array $method, string $statusCode, array $variables = [])
    {
        parent::__construct($method, $statusCode);
        $this->variables = $variables;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }
}
