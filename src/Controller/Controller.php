<?php

namespace App\Controller;

class Controller
{
    protected array $variables;

    /**
     * Constructor of the Controller class
     * @param array $variables
     */
    public function __construct(array $variables = [])
    {
        $this->variables = $variables;
    }

    /**
     * Get all variables
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * Redirect to a view
     * @param string $path
     * @return void
     */
    public static function view(string $path): void
    {
        require_once SOURCE_DIR . "/view/" . $path . ".php";
    }
}
