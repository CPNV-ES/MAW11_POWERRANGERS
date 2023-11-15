<?php

use model\class\HandlerResponse;
use model\class\Route;
use model\class\Router;
use model\class\Handler;
use model\class\Renderer;
use model\class\Request;
use model\class\RouterResponse;

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');

//load all dependencies
require_once BASE_DIR.'/vendor/autoload.php';
require_once SOURCE_DIR.'/Router.php';
require_once SOURCE_DIR.'/Handler.php';
require_once SOURCE_DIR.'/Renderer.php';
require_once SOURCE_DIR.'/Request.php';
require_once SOURCE_DIR.'/Route.php';
require_once SOURCE_DIR.'/RouterResponse.php';
require_once SOURCE_DIR.'/HandlerResponse.php';



//check if an exception is throw and catch it to display error 500 page
try {
    // Load environment variable
    $dotenv = Dotenv\Dotenv::createImmutable(SOURCE_DIR."/..");
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
    $routes[] = new Route("/exercises/new", "GET", "view/pages/exerciseCreate");
    $routes[] = new Route("/exercises/new", "POST", "controller/exerciseCreate");
    $routes[] = new Route("/exercises/{exerciseId}/fields", "GET", "controller/fields");
    $routes[] = new Route("/exercises/{exerciseId}/fields", "POST", "controller/fieldsCreate");
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
