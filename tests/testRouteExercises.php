<?php

namespace Tests;

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once '../vendor/autoload.php';

use App\Controller\Controller;
use App\Controller\ExercisesController;
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
        $routes[] = new Route("/", "GET", [Controller::class, "pages/home"]);
        $routes[] = new Route("/exercises", "GET", [ExercisesController::class, "index"]);

        $router = new Router($this->request, $routes);

        //----------------------------------------//
        // Handler
        // Initialize handler
        $handler = new Handler($router->findRoute());

        $handlerResponse = new HandlerResponse($handler->getRender(), $handler->getStatusCode());

        //----------------------------------------//
        $this->assertStringContainsString("controller/exercises.php", $handlerResponse->getPath());
        $this->assertEquals(200, $handlerResponse->getStatusCode());
    }
}
