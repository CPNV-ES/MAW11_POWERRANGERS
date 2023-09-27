<?php

namespace model\class;

require_once dirname(__FILE__).'/../src/Route.php';
class Routes
{
    // Attributes
    private array $routes = [];

    /**
     * @param Route $route
     */
    public function add(Route $route) : void
    {
        $this->routes[] = $route;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}