<?php

use model\class\HandlerResponse;
use model\class\Renderer;
use PHPUnit\Framework\TestCase;

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');

require_once SOURCE_DIR.'/Renderer.php';
require_once BASE_DIR.'/vendor/autoload.php';
require_once SOURCE_DIR.'/HandlerResponse.php';

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
