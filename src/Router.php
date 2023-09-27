<?php

namespace model\class;

class Router
{
    private string $layout = "views/layout";
    private array $routes = [];
    private string $handler;
    private string $status_code;


    public function add(string $route, string $method, string $handler, string $status_code = "200") : void
    {
        $this->routes[] = [
            "route" => $route,
            "method" => $method,
            "handler" => $handler
        ];
    }

    public function run(string $routeRequest, string $methodRequest) : void
    {
        foreach ($this->routes as $route) {
            if ($route["route"] === $routeRequest && $route["method"] === $methodRequest) {
                $this->handler = $route["handler"];
            }
        }
        if (!isset($this->handler)) {
            $this->handler = "views/error";
            $this->status_code = "404";
        }
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

    public function getStatusCode(): string
    {
        return $this->status_code;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }



}