<?php

namespace App;

use App\Controller\Controller;
use App\Controller\ErrorController;
use Exception;

/**
 * Class Handler
 * @package App\Model
 */
class Handler
{
    // attributes
    
    private HandlerResponse $handlerResponse;
    /**
     * Handler constructor
     * @param RouterResponse $routerResponse
     * @throws Exception
     */
    public function __construct(RouterResponse $routerResponse)
    {
        $this->handle($routerResponse->getStatusCode(), $routerResponse->getMethod());
    }

    /**
     * @throws Exception
     */
    public function handle(int $statusCode, array $method) : void
    {
        //check if class exists
        if (class_exists($method[0])) {
            if ($method[0] == Controller::class) {
                //check method[1] is a valid path
                if (file_exists(SOURCE_DIR . "/view/" . $method[1] . ".php")) {
                    $this->handlerResponse = new HandlerResponse($method, $statusCode);
                    return;
                }
            }
            //if class exists, check if method exists
            if (method_exists($method[0], $method[1])) {
                $this->handlerResponse = new HandlerResponse($method, $statusCode);
                return;
            }
            $this->handlerResponse = new HandlerResponse([ErrorController::class, "index"], 404);
        }
    }

    public function getHandlerResponse() :HandlerResponse {
        return $this->handlerResponse;
    }
}
