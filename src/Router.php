<?php

namespace model\class;

use Exception;

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/../src/Routes.php';

class Router
{
    // Attributes
    private Routes $routes;
    private string $handler;
    private int $status_code;

    /**
     * Router constructor.
     */
    public function __construct()
    {
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
        $routeRequest = $route;
        $methodRequest = $method;

        foreach ($this->routes->getRoutes() as $route) {
            if ($route->getRoute() == $routeRequest && $route->getMethod() == $methodRequest) {
                throw new Exception("Route already exists");
            }
        }
        $route = new Route($route, $method, $handler, $status_code);
        $this->routes->add($route);
    }

    /**
     * @param string $routeRequest
     * @param string $methodRequest
     */
    public function run(string $routeRequest, string $methodRequest) : void
    {
        foreach ($this->routes->getRoutes() as $route) {
            if ($route->getRoute() === $routeRequest && $route->getMethod() === $methodRequest) {
                $this->handler = $route->getHandler();
                $this->status_code = $route->getStatusCode();
            }
        }
        if (!isset($this->handler)) {
            $this->handler = "view/error";
            $this->status_code = 404;
        }
    }

    /**
     * @return Routes
     */
    public function getRoutes(): \model\class\Routes
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
}
