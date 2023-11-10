<?php

use model\class\HandlerResponse;
use model\class\Route;
use model\class\Router;
use model\class\Handler;
use model\class\Renderer;
use model\class\Request;
use model\class\RouterResponse;

//load all dependencies
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Router.php';
require_once __DIR__.'/../src/Handler.php';
require_once __DIR__.'/../src/Renderer.php';
require_once __DIR__.'/../src/Request.php';
require_once __DIR__.'/../src/Route.php';
require_once __DIR__.'/../src/RouterResponse.php';
require_once __DIR__.'/../src/HandlerResponse.php';

//check if an exception is throw and catch it to display error 500 page
try {
    // Load environment variable
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "../..");
    $dotenv->load();

    // Get requested route and init route and method variables
    $route = $_SERVER["REQUEST_URI"];
    if (!empty($_SERVER["QUERY_STRING"])) {
        $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
    }
    $method = $_SERVER["REQUEST_METHOD"];
    $request = new Request($route, $method);


    //----------------------------------------//
    //Router
    // Initialize router

    // Add your routes here
    $routes[] = new Route("/", "GET", "view/pages/home");
    $routes[] = new Route("/exercises", "GET", "controller/exercises");
    $routes[] = new Route("/exercises/new", "GET", "view/pages/exercise-new");
    $routes[] = new Route("/exercises/new", "POST", "controller/exercise-new");
    $routes[] = new Route("/exercises/{exerciseId}/fields", "GET", "controller/fields");
    $routes[] = new Route("/exercises/{exerciseId}/fields", "POST", "controller/fieldsInsert");
    $routes[] = new Route("/exercises/{exerciseId}/answer", "GET", "view/pages/answerCreate");

    $router = new Router($request, $routes);

    $routerResponse = new RouterResponse($router->getHandler(), $router->getStatusCode(), $router->getVariables());

    //----------------------------------------//
    // Handler
    // Initialize handler
    $handler = new Handler($routerResponse);

    $handlerResponse = new HandlerResponse($handler->getRender(), $handler->getStatusCode());

    //----------------------------------------//
    // Renderer
    // Initialize renderer
    $renderer = new Renderer($handlerResponse, $routerResponse->getVariables());

    //----------------------------------------//

} catch (Exception) {
    //set handler and status code for error 500
    $handle = "view/errors";
    $status_code = 500;
    $routerResponse = new RouterResponse($handle, $status_code);
    //----------------------------------------//
    // handler
    // Initialize handler
    $handler = new Handler($routerResponse);

    $handlerResponse = new HandlerResponse($handler->getRender(), $handler->getStatusCode());

    //----------------------------------------//
    // Renderer
    // Initialize renderer
    $renderer = new Renderer($handlerResponse, $routerResponse->getVariables());

    //----------------------------------------//
}
