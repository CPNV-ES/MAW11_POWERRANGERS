<?php

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

//const of fields length
define('FIELD_SINGLE_LINE', 64);
define('FIELD_MULTI_LINE', 255);
define('FIELD_LIST_OF_SINGLE_LINE', 128);

require_once '../vendor/autoload.php';

use App\Controller\AnswersController;
use App\Controller\ExercisesController;
use App\Controller\FieldController;
use App\Controller\FieldsController;
use App\Controller\Controller;
use App\Controller\FullfilmentsController;
use App\Handler;
use App\Renderer;
use App\Request;
use App\Route;
use App\Router;

//check if an exception is throw and catch it to display error 500 page
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

$routes[] = new Route("/", "GET", [Controller::class, "pages/home"]);
$routes[] = new Route("/exercises", "GET", [ExercisesController::class, "index"]);
$routes[] = new Route("/exercises/new", "GET", [Controller::class, "/pages/exerciseCreate"]);
$routes[] = new Route("/exercises/new", "POST", [ExercisesController::class, "store"]);
$routes[] = new Route("/exercises/{exerciseId}/fields", "GET", [FieldsController::class, "index"]);
$routes[] = new Route("/exercises/{exerciseId}/answer", "GET", [AnswersController::class, "create"]);
$routes[] = new Route("/exercises/{exerciseId}/answer", "POST", [FullfilmentsController::class, "create"]);
$routes[] = new Route("/exercises/{exerciseId}/fields", "POST", [FieldsController::class, "store"]);
$routes[] = new Route("/exercises/{exerciseId}/fulfillments/{fulfillmentsId}", "GET", [FullfilmentsController::class, "show"]);
$routes[] = new Route("/exercises/{exerciseId}/results/{fieldId}", "GET", [FieldController::class, "index"]);
$routes[] = new Route(
    "/exercises/{exerciseId}/answer/{answerId}/edit",
    "GET",
    [AnswersController::class, "edit"]
);
$routes[] = new Route(
    "/exercises/{exerciseId}/answer/{answerId}/edit",
    "POST",
    [AnswersController::class, "update"]
);
$routes[] = new Route(
    "/exercises/{exerciseId}/fields/{fieldId}/delete",
    "GET",
    [FieldsController::class, "destroy"]
);
$routes[] = new Route(
    "/exercises/{exerciseId}/fields/{fieldId}",
    "GET",
    [FieldsController::class, "edit"]
);
$routes[] = new Route(
    "/exercises/{exerciseId}/fields/{fieldId}/edit",
    "POST",
    [FieldsController::class, "update"]
);

$router = new Router($request, $routes);
$handler = new Handler($router->getRouterResponse());
$renderer = new Renderer($handler->getHandlerResponse(), $router->getVariables());
