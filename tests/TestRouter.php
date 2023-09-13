<?php


use model\class\Router;
use PHPUnit\Framework\TestCase;


require_once dirname(__FILE__).'/../src/Router.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

class TestRouter extends TestCase
{
    public function testInitSuccess()
    {
        $router = new Router();
        $this->assertInstanceOf(Router::class, $router);
    }
}
