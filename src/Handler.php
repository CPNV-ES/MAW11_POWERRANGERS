<?php

namespace model\class;

use Exception;

/**
 * Class Handler
 * @package model\class
 */
class Handler
{
    // attributes
    private int $status_code;
    private string $path;
    private string $render;

    /**
     * Handler constructor.
     *
     * @param RouterResponse $routerResponse
     * @throws Exception
     */
    public function __construct(RouterResponse $routerResponse) //TODO : why is this a string on status code?
    {
        //set attributes
        $this->status_code = $routerResponse->getStatusCode();
        $this->path = $routerResponse->getPath();
        $this->handle();
    }

    /**
     * @throws Exception
     */
    private function handle() : void
    {
        //check if handler exists and set render
        if ($this->status_code == 200 && file_exists(__DIR__ . '/' . $this->path . '.php'))
        {
            $this->render = __DIR__ . '/' . $this->path . '.php';
        }

        //check if error handler exists and set render
        elseif (file_exists(__DIR__ . '/' . $this->path . "/" . $this->status_code . ".php"))
        {
            $this->render = __DIR__ . '/' . $this->path . "/" . $this->status_code . ".php";
        }

        //if handler doesn't exist, set render to error 500
        else
        {
            $this->status_code = 500;
            $this->render = __DIR__ . $this->path . "/" . $this->status_code . ".php";
        }
    }

    /**
     * @return string
     */
    public function getRender() : string
    {
        return $this->render;
    }

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->status_code;
    }
}
