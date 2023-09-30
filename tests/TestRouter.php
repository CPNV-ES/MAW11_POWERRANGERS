<?php

use model\class\Router;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

/**
 * @covers Router
 */
class TestRouter extends TestCase
{
    /**
     * @covers Router::__construct
     */
    public function testInitSuccess()
    {
        $router = new Router();
        $this->assertInstanceOf(Router::class, $router);
    }

    /**
     * @covers Router::add
     * @throws Exception
     */
    public function testAddSuccess()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");

        $routes = $router->getRoutes();

        $routeExists = false;
        foreach ($routes->getRoutes() as $route) {
            if ($route->getRoute() === '/' && $route->getMethod() === 'GET' && $route->getHandler() === 'views/exercise' && $route->getStatusCode() === 200) {
                $routeExists = true;
                break;
            }
        }
        $this->assertTrue($routeExists);
    }

    /**
     * @covers Router::add
     * @throws Exception
     */
    public function testAddError()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");

        $this->expectException(Exception::class);
        $router->add("/", "GET", "views/exercise");
    }

    /**
     * @covers Router::run
     * @throws Exception
     */
    public function testRunSuccess()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");
        $router->run("/", "GET");

        $this->assertEquals("views/exercise", $router->getHandler());
    }

    /**
     * @covers Router::run
     * @throws Exception
     */
    public function testRunError()
    {
        $router = new Router();
        $router->add("/", "GET", "views/exercise");
        $router->run("/errors", "GET");

        $this->assertEquals("view/errors", $router->getHandler());
        $this->assertEquals("404", $router->getStatusCode());
    }

}
