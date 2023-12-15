<?php

namespace App;

use App\Controller\Controller;

/**
 * This class is designed to manage the rendering process.
 */
class Renderer
{
    private array $render;
    private string $httpResponse;
    private array $variables;

    /**
     * This constructor allow to create a new renderer object
     *
     * @param string $render the content of the view
     * @param string $httpResponse the http response (actually the code response)
     */
    public function __construct(HandlerResponse $handlerResponse, array $variables = [])
    {
        //initialize attributes
        $this->render = $handlerResponse->getMethod();
        $this->httpResponse = $handlerResponse->getStatusCode();
        $this->variables = $variables;
        $this->send();
    }

    /**
     *  This method is used to send information response.
     *
     * @return void
     */
    private function send(): void
    {
        http_response_code($this->httpResponse);
        if ($this->render[0] == Controller::class) {
            require SOURCE_DIR . "/view/" . $this->render[1] . ".php";
        } else {
            $class = $this->render[0];
            $method = $this->render[1];
            $result = new $class($this->variables);
            $result->$method();
        }
    }
}
