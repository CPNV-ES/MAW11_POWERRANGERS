<?php

use model\class\HandlerResponse;
use model\class\Request;
use model\class\Route;
use model\class\Router;
use model\class\Handler;
use model\class\RouterResponse;
use PHPUnit\Framework\TestCase;

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');

require_once SOURCE_DIR.'/Router.php';
require_once SOURCE_DIR.'/Handler.php';
require_once BASE_DIR.'/vendor/autoload.php';
require_once SOURCE_DIR.'/Route.php';
require_once SOURCE_DIR.'/Request.php';
require_once SOURCE_DIR.'/RouterResponse.php';
require_once SOURCE_DIR.'/HandlerResponse.php';

class TestRouteExercises extends TestCase
{
    //attributes
    private string $route = "/exercises";
    private string $method = "GET";

    private Request $request;

    protected function setUp(): void
    {
        $this->request = new Request($this->route, $this->method);    }

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
