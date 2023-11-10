<?php

use model\class\Request;
use model\class\Route;
use model\class\Router;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/../src/Route.php';
require_once dirname(__FILE__).'/../src/Request.php';

/**
 * @covers Router
 */
class TestRouter extends TestCase
{
    private array $routes;

    protected function setUp(): void
    {
        $this->routes[] = new Route("/", "GET", "view/pages/home");
        $this->routes[] = new Route("/exercises", "GET", "controller/exercises");
        $this->routes[] = new Route("/exercises/new", "GET", "view/pages/exercise-new");
        $this->routes[] = new Route("/exercises/new", "POST", "controller/exercise-new");
    }

    /**
     * @covers Router::__construct
     */
    public function testInitSuccess()
    {
        $router = new Router(new Request("/", "GET"), $this->routes);
        $this->assertInstanceOf(Router::class, $router);
    }

    /**
     * @covers Router::add
     * @throws Exception
     */
    public function testInitError()
    {
        $this->routes[] = new Route("/", "GET", "view/pages/home");
        $this->expectException(Exception::class);
        new Router(new Request("/", "GET"), $this->routes);
    }

    /**
     * @covers Router::run
     * @throws Exception
     */
    public function testRunSuccess()
    {
        $router = new Router(new Request("/", "GET"), $this->routes);
        $this->assertEquals("view/pages/home", $router->getHandler());
    }

    /**
     * @covers Router::run
     * @throws Exception
     */
    public function testRunError()
    {
        $router = new Router(new Request("/error", "GET"), $this->routes);

        $this->assertEquals("view/errors", $router->getHandler());
        $this->assertEquals("404", $router->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testAddWithVariable()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", "view/exercise");
        $this->routes[] = new Route("/exercises/{exerciseId}/fields", "POST", "controller/fieldsInsert");

        $router = new Router(new Request("/", "GET"), $this->routes);

        $routes = $router->getRoutes();

        $routeExists = false;
        foreach ($routes as $route) {
            if ($route->getRoute() === '/exercises/{id}' && $route->getMethod() === 'GET' && $route->getHandler(
                ) === 'view/exercise' && $route->getStatusCode() === 200) {
                $routeExists = true;
                break;
            }
        }
        $this->assertTrue($routeExists);
    }

    public function testRunWithVariable()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", "view/exercise");
        $this->routes[] = new Route("/exercises/{exerciseId}/fields", "POST", "controller/fieldsInsert");

        $router = new Router(new Request("/exercises/1", "GET"), $this->routes);

        $this->assertEquals("view/exercise", $router->getHandler());
        $variable = $router->getVariables();
        $this->assertEquals("1", $variable["id"]);
    }

    /**
     * @throws Exception
     */
    public function testRunWithVariableError()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", "view/exercise");
        $this->routes[] = new Route("/exercises/{exerciseId}/fields", "POST", "controller/fieldsInsert");

        $router = new Router(new Request("/error/1", "GET"), $this->routes);

        $this->assertEquals("view/errors", $router->getHandler());
        $this->assertEquals("404", $router->getStatusCode());
        $variable = $router->getVariables();
        $this->assertEmpty($variable);
    }

    /**
     * @throws Exception
     */
    public function testRunWithMultipleVariableSuccess()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", "view/exercise");
        $this->routes[] = new Route("/exercises/{id}/{test}", "GET", "view/exercise2");

        $router = new Router(new Request("/exercises/1/2", "GET"), $this->routes);

        $this->assertEquals("view/exercise2", $router->getHandler());
        $variable = $router->getVariables();
        $this->assertEquals("1", $variable["id"]);
        $this->assertEquals("2", $variable["test"]);
    }

    public function testRouteSelectCorrectRouteSuccess()
    {
        $routes[] = new Route("/exercises/{id}/fields", "GET", "view/exercise2");
        $routes[] = new Route("/exercises/{id}", "GET", "view/exercise");

        $router = new Router(new Request("/exercises/1", "GET"), $routes);

        $this->assertEquals("view/exercise", $router->getHandler());
        $variable = $router->getVariables();
        $this->assertEquals("1", $variable["id"]);
    }
}
