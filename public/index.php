<?php

use model\class\Router;
use model\class\Handler;
use model\class\Renderer;

//load all dependencies
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Router.php';
require_once __DIR__.'/../src/Handler.php';
require_once __DIR__.'/../src/Renderer.php';

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



    //----------------------------------------//
    //Router
    // Initialize router
    $router = new Router();

    // Add your routes here
    $router->add("/", "GET", "controller/home");
    $router->add("/exercises", "GET", "controller/exercises");
    $router->add("/exercises/99/fields", "GET", "controller/exercises");
    $router->add("/exercises/99/fields", "POST", "controller/exercises");

    // check if route requested exists
    $router->run($route, $method);

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
    // Renderer
    // Initialize renderer
    $renderer = new Renderer($handle, $status_code);

    //render page with handler and return page and status code to client
    $renderer->send();
    //----------------------------------------//

} catch (Exception) {
    //set handler and status code for error 500
    $handle = "view/errors";
    $status_code = 500;

    //----------------------------------------//
    // handler
    // Initialize handler
    $handler = new Handler($handle, $status_code);

    //check if handler exists
    $handler->handle();

    //set handler and status code
    $render = $handler->getRender();
    $status_code = $handler->getStatusCode();

    //----------------------------------------//
    // Renderer
    // Initialize renderer
    $renderer = new Renderer($render, $status_code);

    //render page with handler and return page and status code to client
    $renderer->send();
    //----------------------------------------//
}
