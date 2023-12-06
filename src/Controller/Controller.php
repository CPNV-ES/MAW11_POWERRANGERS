<?php

namespace App\Controller;

class Controller
{
    protected array $variables;

    public function __construct($variables = array())
    {
        $this->variables = $variables;
    }

    public function getVariables() : array
    {
        return $this->variables;
    }

    public static function view(string $path): void
    {
        require_once SOURCE_DIR . "/view/" . $path . ".php";
    }
}
