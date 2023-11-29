<?php

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

//const of fields length
define('FIELD_SINGLE_LINE', 64);
define('FIELD_MULTI_LINE', 255);
define('FIELD_LIST_OF_SINGLE_LINE', 128);

require_once '../vendor/autoload.php';

use App\Handler;
use App\HandlerResponse;
use App\Renderer;
use App\Request;
use App\Route;
use App\Router;
use App\RouterResponse;

//check if an exception is throw and catch it to display error 500 page
try {
    // Load environment variable
    $dotenv = Dotenv\Dotenv::createImmutable(SOURCE_DIR . "/..");
    $dotenv->load();

    // Get requested route and init route and method variables
    $route = $_SERVER["REQUEST_URI"];
    if (!empty($_SERVER["QUERY_STRING"])) {
        $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
    }
    $method = $_SERVER["REQUEST_METHOD"];
    $request = new Request($route, $method);

    // Add your routes here
    $routes[] = new Route("/", "GET", "view/pages/home");
    $routes[] = new Route("/exercises", "GET", "controller/exercises");
    $routes[] = new Route("/exercises/new", "GET", "view/pages/exerciseCreate");
    $routes[] = new Route("/exercises/new", "POST", "controller/exerciseCreate");
    $routes[] = new Route("/exercises/{exerciseId}/fields", "GET", "controller/fields");
    $routes[] = new Route("/exercises/{exerciseId}/answer", "GET", "controller/answerCreate");
    $routes[] = new Route("/exercises/{exerciseId}/answer", "POST", "controller/fulfillmentCreate");
    $routes[] = new Route("/exercises/{exerciseId}/fields", "POST", "controller/fieldsCreate");
    $routes[] = new Route(
        "/exercises/{exerciseId}/answer/{answerId}/edit",
        "GET",
        "controller/answerEditView"
    );
    $routes[] = new Route(
        "/exercises/{exerciseId}/answer/{answerId}/edit",
        "POST",
        "controller/answerEdit"
    );
    $routes[] = new Route(
        "/exercises/{exerciseId}/fields/{fieldId}/delete",
        "GET",
        "controller/fieldsDelete"
    );
    $routes[] = new Route(
        "/exercises/{exerciseId}/fields/{fieldId}",
        "GET",
        "controller/fieldsUpdateView"
    );
    $routes[] = new Route(
        "/exercises/{exerciseId}/fields/{fieldId}/edit",
        "POST",
        "controller/fieldsUpdate"
    );

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
