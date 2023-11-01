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
    private string $handler;
    private string $render;

    /**
     * Handler constructor.
     * @param string $handler
     * @param string $status_code
     * @throws Exception
     */
    public function __construct(string $handler, string $status_code) //TODO : why is this a string on status code?
    {
        //set attributes
        $this->status_code = $status_code;
        $this->handler = $handler;
    }

    /**
     * @throws Exception
     */
    public function handle() : void
    {
        //check if handler exists and set render
        if ($this->status_code == 200 && file_exists(__DIR__ . '/' . $this->handler . '.php'))
        {
            $this->render = __DIR__ . '/' . $this->handler . '.php';
        }

        //check if error handler exists and set render
        elseif (file_exists(__DIR__ . '/' . $this->handler . "/" . $this->status_code . ".php"))
        {
            $this->render = __DIR__ . '/' . $this->handler . "/" . $this->status_code . ".php";
        }

        //if handler doesn't exist, set render to error 500
        else
        {
            $this->status_code = 500;
            $this->render = __DIR__ . $this->handler . "/" . $this->status_code . ".php";
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
