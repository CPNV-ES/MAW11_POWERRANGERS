<?php

use model\class\Router;
use model\class\Handler;
use model\class\Renderer;

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../src/Handler.php';
require_once dirname(__FILE__).'/../src/Renderer.php';

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "../..");
$dotenv->load();

// Get requested route
$route = $_SERVER["REQUEST_URI"];
if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"])-strlen($_SERVER["QUERY_STRING"])-1);
}
$method = $_SERVER["REQUEST_METHOD"];

$router = new Router();

//----------------------------------------//
// Add your routes here

$router->add("/exercises", "GET", "view/pages/exercises");

//----------------------------------------//

$router->run($route, $method);
$handle = $router->getHandler();
$status_code = $router->getStatusCode();

//----------------------------------------//
// handler
$handler = new Handler($handle, $status_code);
$handler->handle();
$render = $handler->getRender();
$status_code = $handler->getStatusCode();
//----------------------------------------//
// Renderer
$renderer = new Renderer($render, $status_code);
$renderer->send();