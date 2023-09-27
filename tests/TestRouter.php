<?php


use model\class\Router;
use PHPUnit\Framework\TestCase;


require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

class TestRouter extends TestCase
{
    public function testInitSuccess()
    {
        $router = new Router();
        $this->assertInstanceOf(Router::class, $router);
    }

    public function testAddSuccess()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");

        $routes = $router->getRoutes();

        $routeExists = false;
        foreach ($routes as $route) {
            if ($route['route'] === '/' && $route['method'] === 'GET' && $route['handler'] === 'views/exercise') {
                $routeExists = true;
                break;
            }
        }
        $this->assertTrue($routeExists, 'the route has not been added');
    }

    public function testRunSuccess()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");
        $router->run("/", "GET");

        $this->assertEquals("views/exercise", $router->getHandler(), 'the handler is not correct');
    }

    public function testRunError()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");
        $router->run("/error", "GET");

        $this->assertEquals("views/error", $router->getHandler(), 'the handler is not correct');
        $this->assertEquals("404", $router->getStatusCode(), 'the status code is not correct');
    }

}
