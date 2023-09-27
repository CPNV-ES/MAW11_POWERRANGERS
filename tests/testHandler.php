<?php

use model\class\Handler;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/Handler.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

class TestHandler extends TestCase
{
    // attributes
    private $handler = "controller/testController";
    private $status_code = 200;

    /**
     * @throws Exception
     */
    public function testInitSuccess()
    {
        $handler = new Handler($this->handler, $this->status_code);
        $this->assertInstanceOf(Handler::class, $handler);
    }

    /**
     * @throws Exception
     */
    public function testHandleSuccess()
    {
        $handler = new Handler($this->handler, $this->status_code);
        $handler->handle();
        $this->assertIsString($handler->getRender());
        $this->assertEquals(200, $handler->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testHandleFailed()
    {
        $handler = new Handler("controller/errorController", $this->status_code);
        $handler->handle();
        $this->assertEquals(500, $handler->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testGetRenderErrorCodesSuccess()
    {
        $handler = new Handler("view/error", 404);
        $handler->handle();
        $this->assertEquals(404, $handler->getStatusCode());
    }
}