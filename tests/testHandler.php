<?php

namespace Tests;

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once '../vendor/autoload.php';

use App\Handler;
use App\RouterResponse;
use PHPUnit\Framework\TestCase;

class TestHandler extends TestCase
{
    // attributes
    private $handler = "controller/exercises";
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
        $this->assertIsString($handler->getRender());
        $this->assertEquals(200, $handler->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testHandleFailed()
    {
        $handler = new Handler(new RouterResponse("controller/exercises3", $this->status_code));
        $this->assertEquals(500, $handler->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testGetRenderErrorCodesSuccess()
    {
        $handler = new Handler(new RouterResponse("view/errors", 404));
        $this->assertEquals(404, $handler->getStatusCode());
    }
}
