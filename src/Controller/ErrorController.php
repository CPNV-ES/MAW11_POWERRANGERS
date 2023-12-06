<?php

namespace App\Controller;

class ErrorController extends Controller
{
    public function index(): void
    {
        $this->view('errors/404');
    }
}
