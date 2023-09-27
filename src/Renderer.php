<?php

namespace model\class;

/**
 * This class is designed to manage the rendering process.
 */
class Renderer
{
    private string $render;
    private string $httpResponse;

    /**
     * This constructor allow to create a new renderer object
     *
     * @param string $render the content of the view
     * @param string $httpResponse the http response (actually the code response)
     */
    public function __construct(string $render, string $httpResponse)
    {
       $this->render = $render;
       $this->httpResponse = $httpResponse;
    }

    /**
     *  This method is used to send information response.
     *
     * @return void
     */
    public function send(): void
    {
        //TODO : Add header on the response.
        http_response_code($this->httpResponse);
        require $this->render;
    }
}