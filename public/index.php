<?php

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');


//const of fields length
define('FIELD_SINGLE_LINE', 64);
define('FIELD_MULTI_LINE', 255);
define('FIELD_LIST_OF_SINGLE_LINE', 128);


require_once '../vendor/autoload.php';

use App\Controller\AnswersController;
use App\Controller\ErrorController;
use App\Controller\ExercisesController;
use App\Controller\FieldController;
use App\Controller\FieldsController;
use App\Controller\Controller;
use App\Controller\FullfilmentsController;
use App\Controller\ResultController;
use App\Controller\ManageController;
use App\Controller\ExercisesStatusController;
use App\Handler;
use App\HandlerResponse;
use App\Renderer;
use App\Request;
use App\Route;
use App\Router;

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(SOURCE_DIR . "/..");
$dotenv->load();

// Get requested route and init route and method variables
$route = $_SERVER["REQUEST_URI"];
if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
}
if (isset($_POST["_method"])) {
    $_SERVER["REQUEST_METHOD"] = $_POST["_method"];
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
    "DELETE",
    [FieldsController::class, "destroy"]
);
$routes[] = new Route(
    "/exercises/{exerciseId}/fields/{fieldId}",
    "PUT",
    [FieldsController::class, "edit"]
);
$routes[] = new Route(
    "/exercises/{exerciseId}/fields/{fieldId}/edit",
    "POST",
    [FieldsController::class, "update"]
);
$routes[] = new Route("/exercises/{exerciseId}/results", "GET", [ResultController::class, "index"]);
$routes[] = new Route("/manage", "GET", [ManageController::class, "index"]);
$routes[] = new Route("/exercises/{exerciseId}/status", "PUT", [ExercisesStatusController::class, "update"]);
$routes[] = new Route("/exercises/{exerciseId}", "DELETE", [ExercisesController::class, "destroy"]);

$router = new Router($request, $routes);
$handler = new Handler($router->getRouterResponse());
try {
    $renderer = new Renderer($handler->getHandlerResponse(), $router->getVariables());
} catch (Exception $e) {
    $variables["errorMessage"] = $e->getMessage();
    $renderer = new Renderer(new HandlerResponse([ErrorController::class, "index"], $e->getCode()), $variables);
}
