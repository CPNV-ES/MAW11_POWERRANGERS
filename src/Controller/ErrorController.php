<?php

namespace App\Controller;

class ErrorController extends Controller
{
    public function index(): void
    {
        $this->view("errors/".http_response_code());
    }
}
