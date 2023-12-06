<?php

namespace Tests;

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once '../vendor/autoload.php';

use App\Controller\Controller;
use App\Controller\ErrorController;
use App\Controller\ExercisesController;
use App\Controller\FieldsController;
use App\Request;
use App\Route;
use App\Router;
use App\RouterResponse;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * @covers \model\class\framework\Router
 */
class TestRouter extends TestCase
{
    private array $routes;

    protected function setUp(): void
    {
        $this->routes[] = new Route("/", "GET", [Controller::class, "/pages/home"]);
        $this->routes[] = new Route("/exercises", "GET", [ExercisesController::class, "index"]);
        $this->routes[] = new Route("/exercises/new", "GET", [Controller::class, "/pages/exercise-new"]);
    }

    /**
     * @covers \model\class\framework\Router::__construct
     */
    public function testInitSuccess()
    {
        $router = new Router(new Request("/", "GET"), $this->routes);
        $this->assertInstanceOf(Router::class, $router);
    }

    /**
     * @covers \model\class\framework\Router::add
     * @throws Exception
     */
    public function testInitError()
    {
        $this->routes[] = new Route("/", "GET", [Controller::class, "/pages/home"]);
        $this->expectException(Exception::class);
        new Router(new Request("/", "GET"), $this->routes);
    }

    /**
     * @covers \model\class\framework\Router::run
     * @throws Exception
     */
    public function testRunSuccess()
    {
        $router = new Router(new Request("/", "GET"), $this->routes);
        $routerResponse = $router->getRouterResponse();
        $this->assertEquals([Controller::class, "/pages/home"], $routerResponse->getMethod());
    }

    /**
     * @covers \model\class\framework\Router::run
     * @throws Exception
     */
    public function testRunError()
    {
        $router = new Router(new Request("/error", "GET"), $this->routes);
        $routerResponse = $router->getRouterResponse();

        $this->assertEquals([ErrorController::class, "errors"], $routerResponse->getMethod());
        $this->assertEquals("404", $routerResponse->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testAddWithVariable()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", [Controller::class, "/exercise"]);
        $this->routes[] = new Route("/exercises/{exerciseId}/fields", "POST", [FieldsController::class, "create"]);

        $router = new Router(new Request("/", "GET"), $this->routes);

        $routes = $router->getRoutes();

        $routeExists = false;
        foreach ($routes as $route) {
            if (
                $route->getRoute() === '/exercises/{id}' && $route->getMethod() === 'GET' && $route->getHandler(
                ) === [Controller::class, "/exercise"] && $route->getStatusCode() === 200
            ) {
                $routeExists = true;
                break;
            }
        }
        $this->assertTrue($routeExists);
    }

    public function testRunWithVariable()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", [Controller::class, "/exercise"]);
        $this->routes[] = new Route("/exercises/{exerciseId}/fields", "POST", [FieldsController::class, "store"]);

        $router = new Router(new Request("/exercises/1", "GET"), $this->routes);
        $routerResponse = $router->getRouterResponse();

        $this->assertEquals([Controller::class, "/exercise"], $routerResponse->getMethod());
        $variable = $router->getVariables();
        $this->assertEquals("1", $variable["id"]);
    }

    /**
     * @throws Exception
     */
    public function testRunWithVariableError()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", [Controller::class, "/exercise"]);
        $this->routes[] = new Route("/exercises/{exerciseId}/fields", "POST", [FieldsController::class, "store"]);

        $router = new Router(new Request("/error/1", "GET"), $this->routes);
        $routerResponse = $router->getRouterResponse();

        $this->assertEquals([ErrorController::class, "errors"], $routerResponse->getMethod());
        $this->assertEquals("404", $routerResponse->getStatusCode());
        $variable = $router->getVariables();
        $this->assertEmpty($variable);
    }

    /**
     * @throws Exception
     */
    public function testRunWithMultipleVariableSuccess()
    {
        $this->routes[] = new Route("/exercises/{id}", "GET", [Controller::class, "/exercise"]);
        $this->routes[] = new Route("/exercises/{id}/{test}", "GET", [Controller::class, "/exercise2"]);


        $router = new Router(new Request("/exercises/1/2", "GET"), $this->routes);
        $routerResponse = $router->getRouterResponse();

        $this->assertEquals([Controller::class, "/exercise2"], $routerResponse->getMethod());
        $variable = $router->getVariables();
        $this->assertEquals("1", $variable["id"]);
        $this->assertEquals("2", $variable["test"]);
    }

    public function testRouteSelectCorrectRouteSuccess()
    {
        $this->routes[] = new Route("/exercises/{id}/{test}", "GET", [Controller::class, "/exercise2"]);
        $this->routes[] = new Route("/exercises/{id}", "GET", [Controller::class, "/exercise"]);

        $router = new Router(new Request("/exercises/1", "GET"), $this->routes);
        $routerResponse = $router->getRouterResponse();

        $this->assertEquals([Controller::class, "/exercise"], $routerResponse->getMethod());
        $variable = $router->getVariables();
        $this->assertEquals("1", $variable["id"]);
    }
}
