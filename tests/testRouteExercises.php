<?php

use model\class\Router;
use model\class\Handler;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../src/Handler.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

class TestRouteExercises extends TestCase
{
    //attributes
    private string $route = "/exercises";
    private string $method = "GET";

    /**
     * @throws Exception
     */
    public function testRouteExercisesSuccess()
    {
        //----------------------------------------//
        //Router
        // Initialize router
        $router = new Router();

        // Add your routes here
        $router->add("/", "GET", "controller/home");
        $router->add("/exercises", "GET", "controller/exercises");

        // check if route requested exists
        $router->run($this->route, $this->method);

        //set handler and status code
        $handle = $router->getHandler();
        $status_code = $router->getStatusCode();

        //----------------------------------------//
        // Handler
        // Initialize handler
        $handler = new Handler($handle, $status_code);

        //check if handler exists
        $handler->handle();

        //set handle and status code
        $handle = $handler->getRender();
        $status_code = $handler->getStatusCode();

        //----------------------------------------//
        $this->assertStringContainsString("controller/exercises.php", $handle);
        $this->assertEquals(200, $status_code);
    }

}
