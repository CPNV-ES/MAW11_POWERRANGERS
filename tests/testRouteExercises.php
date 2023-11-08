<?php

use model\class\HandlerResponse;
use model\class\Request;
use model\class\Route;
use model\class\Router;
use model\class\Handler;
use model\class\RouterResponse;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../src/Handler.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/../src/Route.php';
require_once dirname(__FILE__).'/../src/Request.php';
require_once dirname(__FILE__).'/../src/RouterResponse.php';
require_once dirname(__FILE__).'/../src/HandlerResponse.php';

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
