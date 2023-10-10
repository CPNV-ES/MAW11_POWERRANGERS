<?php

namespace model\class;

use Exception;

//load routes class for manage multiple routes
require_once dirname(__FILE__).'/../src/Routes.php';

/**
 * Class Router
 * @package model\class
 */
class Router
{
    // Attributes
    private Routes $routes;
    private string $handler;
    private int $status_code;
    private array $variables;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        //initialize Routes object
        $this->routes = new Routes();
    }

    /**
     * @param string $route
     * @param string $method
     * @param string $handler
     * @param int $status_code
     * @throws Exception
     */
    public function add(string $route, string $method, string $handler, int $status_code = 200) : void
    {
        //set other variables for comprehension
        $routeRequest = $route;
        $methodRequest = $method;

        //check if route exists
        foreach ($this->routes->getRoutes() as $route) {
            if ($route->getRoute() == $routeRequest && $route->getMethod() == $methodRequest) {
                //if route exists, throw exception
                throw new Exception("Route already exists");
            }
        }
        //if route doesn't exist, create new route object and add to routes array
        $route = new Route($routeRequest, $method, $handler, $status_code);
        $this->routes->add($route);
    }

    /**
     * @param string $routeRequest
     * @param string $methodRequest
     */
    public function run(string $routeRequest, string $methodRequest) : void
    {
        //check if route exists
        foreach ($this->routes->getRoutes() as $route) {
            if (str_contains($route->getRoute(), "{" . $route->getVariable() . "}")) {

            }
            if ($route->getRoute() === $routeRequest && $route->getMethod() === $methodRequest) {
                //if route exists, set handler and status code
                $this->handler = $route->getHandler();
                $this->status_code = $route->getStatusCode();
            }
        }
        //if route doesn't exist, set handler to error page and status code to 404
        if (!isset($this->handler)) {
            $this->handler = "view/errors";
            $this->status_code = 404;
        }
    }

    /**
     * @return Routes
     */
    public function getRoutes(): Routes
    {
        return $this->routes;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * @return array
     */
    public function getVariable(): array
    {
        return $this->variables;
    }

}
