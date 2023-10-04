<?php

namespace model\class;

use Exception;

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
        $this->status_code = $status_code;
        $this->handler = $handler;
    }

    /**
     * @throws Exception
     */
    public function handle() : void
    {

        if ($this->status_code == 200 && file_exists(dirname(__FILE__) . '/' . $this->handler . '.php'))
        {
            $this->render = dirname(__FILE__) . '/' . $this->handler . '.php';
        }

        elseif (file_exists(dirname(__FILE__) . '/' . $this->handler . "/" . $this->status_code . ".php"))
        {
            $this->render = dirname(__FILE__) . '/' . $this->handler . "/" . $this->status_code . ".php";
        }

        else
        {
            $this->status_code = 500;
            $this->render = dirname(__FILE__) . $this->handler . "/" . $this->status_code . ".php";
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