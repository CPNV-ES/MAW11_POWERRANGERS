<?php

namespace Tests;

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once '../vendor/autoload.php';

use App\HandlerResponse;
use App\Request;
use App\Route;
use App\Router;
use App\Handler;
use App\RouterResponse;
use PHPUnit\Framework\TestCase;

class TestRouteExercises extends TestCase
{
    //attributes
    private string $route = "/exercises";
    private string $method = "GET";

    private Request $request;

    protected function setUp(): void
    {
        $this->request = new Request($this->route, $this->method);
    }

    /**
     * @throws Exception
     */
    public function testRouteExercisesSuccess()
    {
        //----------------------------------------//
        //Router
        // Initialize router

        // Add your routes here
        $routes[] = new Route("/", "GET", "view/pages/home");
        $routes[] = new Route("/exercises", "GET", "controller/exercises");

        $router = new Router($this->request, $routes);

        $routerResponse = new RouterResponse($router->getHandler(), $router->getStatusCode(), $router->getVariables());

        //----------------------------------------//
        // Handler
        // Initialize handler
        $handler = new Handler($routerResponse);

        $handlerResponse = new HandlerResponse($handler->getRender(), $handler->getStatusCode());

        //----------------------------------------//
        $this->assertStringContainsString("controller/exercises.php", $handlerResponse->getPath());
        $this->assertEquals(200, $handlerResponse->getStatusCode());
    }
}
