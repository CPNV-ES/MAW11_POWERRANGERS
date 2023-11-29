<?php

namespace Tests;

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once '../vendor/autoload.php';

use App\HandlerResponse;
use App\Renderer;
use PHPUnit\Framework\TestCase;

class TestRenderer extends TestCase
{
    // attributes
    private $render = "view/pages/home.php";
    private $httpResponse = 200;
    private HandlerResponse $handlerResponse;
    protected function setUp(): void
    {
        $this->handlerResponse = new HandlerResponse($this->render, $this->httpResponse);
    }

    /**
     * @throws Exception
     */
    public function testInitSuccess()
    {
        $renderer = new Renderer($this->handlerResponse);
        $this->assertInstanceOf(Renderer::class, $renderer);
    }
}
