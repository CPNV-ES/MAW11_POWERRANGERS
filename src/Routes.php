<?php

namespace model\class;

//load route class for manage single route
require_once dirname(__FILE__).'/../src/Route.php';

/**
 * Class Routes
 * @package model\class
 */
class Routes
{
    // Attributes
    private array $routes = [];

    /**
     * @param Route $route
     */
    public function add(Route $route) : void
    {
        //add route to routes array
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