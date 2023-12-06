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
    private int $status_code;
    private array $method;
    /**
     * Handler constructor
     * @param RouterResponse $routerResponse
     * @throws Exception
     */
    public function __construct(RouterResponse $routerResponse)
    {
        //set attributes
        $this->status_code = $routerResponse->getStatusCode();
        $this->method = $routerResponse->getMethod();
        $this->handle();
    }

    /**
     * @throws Exception
     */
    private function handle() : void
    {
        //check if class exists
        if (class_exists($this->method[0])) {
            if ($this->method[0] == Controller::class) {
                //check method[1] is a valid path
                if (file_exists(SOURCE_DIR . "/view/" . $this->method[1] . ".php")) {
                    return;
                }
            }
            //if class exists, check if method exists
            if (method_exists($this->method[0], $this->method[1])) {
                return;
            }
            $this->method = [ErrorController::class, "index"];
            $this->status_code = 404;
        }
    }

    /**
     * @return array
     */
    public function getMethod() : array
    {
        return $this->method;
    }

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->status_code;
    }
}
