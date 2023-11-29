<?php

namespace App;

use Exception;
use App\Route;

/**
 * Class Router
 * @package App\Model
 */
class Router
{
    // Attributes
    private array $routes;
    private string $handler;
    private int $status_code;
    private array $variables;

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
        $routeRequest = $request->getPath();
        $methodRequest = $request->getStatusCode();
        //set routes
        foreach ($routes as $route) {
            $this->add($route->getRoute(), $route->getMethod(), $route->getHandler(), $route->getStatusCode());
        }

        $this->run($routeRequest, $methodRequest);
    }

    /**
     * @param string $route
     * @param string $method
     * @param string $handler
     * @param int $status_code
     * @throws Exception
     */
    private function add(string $route, string $method, string $handler, int $status_code = 200): void
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

    /**
     * @param string $routeRequest
     * @param string $methodRequest
     */
    private function run(string $routeRequest, string $methodRequest): void
    {
        $this->variables = [];
        $routeRequestArray = explode("/", $routeRequest);
        $routeRequestArray = array_filter($routeRequestArray);
        //check if route exists
        foreach ($this->routes as $route) {
            if ($methodRequest == $route->getMethod()) {
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
                    $this->handler = $route->getHandler();
                    $this->status_code = $route->getStatusCode();
                    break;
                }
            }
        }
        //if route doesn't exist, set handler to error page and status code to 404
        if (!isset($this->handler)) {
            $this->handler = "view/errors";
            $this->status_code = 404;
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
    public function getVariables(): array
    {
        return $this->variables;
    }
}
