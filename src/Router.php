<?php

namespace App;

use Exception;
use App\Controller\ErrorController;

/**
 * Class Router
 * @package model\class
 */
class Router
{
    // Attributes
    private array $routes;
    private array $variables;
    private string $routeRequest;
    private string $methodRequest;

    private RouterResponse $routerResponse;

    /**
     * Router constructor.
     *
     * @throws Exception
     */
    public function __construct(Request $request, array $routes)
    {
        //initialize attributes
        $this->routes = [];
        $this->variables = [];
        $this->routeRequest = $request->getPath();
        $this->methodRequest = $request->getMethod();
        //set routes
        foreach ($routes as $route) {
            $this->add($route->getRoute(), $route->getMethod(), $route->getHandler(), $route->getStatusCode());
        }
        $this->findRoute();
    }

    /**
     * @param string $route
     * @param string $method
     * @param string $handler
     * @param int $status_code
     * @throws Exception
     */
    private function add(string $route, string $method, array $handler, int $status_code = 200): void
    {
        //set other variables for comprehension
        $routeRequest = $route;
        $methodRequest = $method;

        //check if route exists
        foreach ($this->routes as $route) {
            if ($route->getRoute() == $routeRequest && $route->getMethod() == $methodRequest) {
                //if route exists, throw exception
                throw new Exception("Route already exists");
            }
        }
        //if route doesn't exist, create new route object and add to routes array
        $route = new Route($routeRequest, $method, $handler, $status_code);
        $this->routes[] = $route;
    }


    public function findRoute(): void
    {
        $this->variables = [];
        $routeRequestArray = explode("/", $this->routeRequest);
        $routeRequestArray = array_filter($routeRequestArray);
        //check if route exists
        foreach ($this->routes as $route) {
            if ($this->methodRequest == $route->getMethod()) {
                //get good route
                $checkValidRoot = true;
                $routeArray = explode("/", $route->getRoute());
                $routeArray = array_filter($routeArray);
                if (count($routeArray) == count($routeRequestArray)) {
                    foreach ($routeRequestArray as $key => $value) {
                        if (!isset($routeArray[$key])) {
                            $checkValidRoot = false;
                            break;
                        }
                        if ($value != $routeArray[$key]) {
                            if (
                                str_contains($routeArray[$key], "{") && str_contains(
                                    $routeArray[$key],
                                    "}"
                                ) && $value != ""
                            ) {
                                $var = str_replace("{", "", $routeArray[$key]);
                                $var = str_replace("}", "", $var);
                                $this->variables[$var] = $value;
                            } else {
                                $this->variables = [];
                                $checkValidRoot = false;
                                break;
                            }
                        }
                    }
                } else {
                    $checkValidRoot = false;
                }
                if ($checkValidRoot) {
                    $this->routerResponse = new RouterResponse($route->getHandler(), $route->getStatusCode(), $this->variables);
                    break;
                }
            }
        }
        if (!isset($this->routerResponse)) {
            $this->routerResponse = new RouterResponse([ErrorController::class, "errors"], 404, $this->variables);
        }
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    public function getRouterResponse(): RouterResponse
    {
        return $this->routerResponse;
    }
}
