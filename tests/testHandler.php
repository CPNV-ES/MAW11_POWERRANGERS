<?php

namespace Tests;

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once '../vendor/autoload.php';

use App\Controller\ErrorController;
use App\Controller\ExercisesController;
use App\Handler;
use App\RouterResponse;
use PHPUnit\Framework\TestCase;

class TestHandler extends TestCase
{
    // attributes
    private $handler = [ExercisesController::class, "index"];
    private $status_code = 200;

    private RouterResponse $routerResponse;

    protected function setUp(): void
    {
        $this->routerResponse = new RouterResponse($this->handler, $this->status_code);
    }

    /**
     * @throws Exception
     */
    public function testInitSuccess()
    {
        $handler = new Handler($this->routerResponse);
        $this->assertInstanceOf(Handler::class, $handler);
    }

    /**
     * @throws Exception
     */
    public function testHandleSuccess()
    {
        $handler = new Handler($this->routerResponse);
        $handlerResponse = $handler->getHandlerResponse();
        $this->assertIsArray($handlerResponse->getMethod());
        $this->assertEquals(200, $handlerResponse->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testHandleFailed()
    {
        $handler = new Handler(new RouterResponse([ExercisesController::class, "storefail"], $this->status_code));
        $handlerResponse = $handler->getHandlerResponse();
        $this->assertEquals(500, $handlerResponse->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testGetRenderErrorCodesSuccess()
    {
        $handler = new Handler(new RouterResponse([ErrorController::class, "index"], 404));
        $handlerResponse = $handler->getHandlerResponse();
        $this->assertEquals(404, $handlerResponse->getStatusCode());
    }
}
