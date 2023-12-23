<?php

namespace App;

/**
 * Class Route
 * @package App\Model
 */
class Route
{
    // Attributes
    private string $route;
    private string $method;
    private array $handler;
    private int $status_code; //TODO : agree on nomenclature.

    /**
     * Route constructor.
     * @param string $route
     * @param string $method
     * @param array $handler
     * @param int $status_code
     */
    public function __construct(string $route, string $method, array $handler, int $status_code = 200)
    {
        //set attributes
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
     * @return array
     */
    public function getHandler(): array
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
