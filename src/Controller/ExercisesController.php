<?php

namespace App\Controller;

use App\Model\Service\Exercises;
class ExercisesController extends Controller
{
    public function __construct($variables = array())
    {
        parent::__construct($variables);
    }
    public function index()
    {
        $exercises = Exercises::getAllExercises();
        require_once SOURCE_DIR . "/view/pages/exercises.php";
    }

    public function store()
    {
        $name = $_POST["ex-name"];

        if (empty($name)) {
            $error_name = "You have to name your exercise";
            // reload view for create a new exercise
            require_once SOURCE_DIR . "/view/pages/exerciseCreate";
        } elseif (strlen($name) > 96) {
            $error_name = "The name of your exercise can't exceed 96 characters";
            // reload view for create a new exercise
            require_once SOURCE_DIR . "/view/pages/exerciseCreate";
        } else {
            $exerciseId = Exercises::createExercise($name);
            header("Location: /exercises/" . $exerciseId . "/fields");
        }
    }
}