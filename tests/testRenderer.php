<?php

use model\class\Renderer;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/Renderer.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

class TestRenderer extends TestCase
{
    // attributes
    private $render = "view/pages/exercises.php";
    private $httpResponse = 200;

    /**
     * @throws Exception
     */
    public function testInitSuccess()
    {
        $renderer = new Renderer($this->render, $this->httpResponse);
        $this->assertInstanceOf(Renderer::class, $renderer);
    }
}
