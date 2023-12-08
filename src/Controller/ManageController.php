<?php

namespace App\Controller;

class ManageController extends Controller
{
    protected array $variables;

    public function index()
    {
//        $exercises = Exercises::getAllExercises();
        require_once SOURCE_DIR . "/view/pages/manage.php";
    }
}
