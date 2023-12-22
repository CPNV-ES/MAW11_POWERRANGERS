<?php

namespace App\Controller;

class ErrorController extends Controller
{
    public function index(): void
    {
        require_once SOURCE_DIR . "/view/pages/error.php";
    }
}
