<?php

namespace model\class;

/**
 * This class is designed to manage the rendering process.
 */
class Renderer
{
    private string $render;
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
        $this->render = $handlerResponse->getPath();
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
        //TODO : Add header on the response.
        http_response_code($this->httpResponse);
        require $this->render;
    }
}
