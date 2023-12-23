<?php

namespace App\Controller;

class ErrorController extends Controller
{
    /**
     * Show error page
     * @return void
     */
    public function index(): void
    {
        require_once SOURCE_DIR . "/view/pages/error.php";
    }
}
