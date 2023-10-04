<?php

namespace model\class;


class Route
{
    // Attributes
    private string $route;
    private string $method;
    private string $handler;
    private int $status_code; //TODO : agree on nomenclature.

    /**
     * Route constructor.
     * @param string $route
     * @param string $method
     * @param string $handler
     * @param int $status_code
     */
    public function __construct(string $route, string $method, string $handler, int $status_code = 200)
    {
        $this->route = $route;
        $this->method = $method;
        $this->handler = $handler;
        $this->status_code = $status_code;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
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