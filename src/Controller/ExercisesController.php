<?php

namespace App\Controller;

use App\Model\Service\Exercises;
use Exception;

class ExercisesController extends Controller
{
    /**
     * Constructor of the ExeciseControler class
     * @param $variables - all variables passes through URL array
     */
    public function __construct($variables = [])
    {
        parent::__construct($variables);
    }

    /**
     * Show the exercise page by getting all exercises
     * @return void
     * @throws Exception
     */
    public function index(): void
    {
        $exercises = [];

        foreach (Exercises::getAllExercises() as $exercise) {
            if ($exercise['status'] == 'Answering') {
                array_push($exercises, $exercise);
            }
        }

        require_once SOURCE_DIR . "/view/pages/exercises.php";
    }

    /**
     * Store a new exercise
     * @return void
     * @throws Exception
     */
    public function store(): void
    {
        $name = $_POST["ex-name"];

        if (empty($name)) {
            $error_name = "You have to name your exercise";
            // reload view for create a new exercise
            require_once SOURCE_DIR . "/view/pages/exerciseCreate.php";
        } elseif (strlen($name) > 96) {
            $error_name = "The name of your exercise can't exceed 96 characters";
            // reload view for create a new exercise
            require_once SOURCE_DIR . "/view/pages/exerciseCreate.php";
        } else {
            $exerciseId = Exercises::createExercise($name);
            header("Location: /exercises/" . $exerciseId . "/fields");
        }
    }

    /**
     * Destroy an exercise
     * @return void
     * @throws Exception
     */
    public function destroy(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        Exercises::deleteExercise(intval($this->variables['exerciseId']));
        header("Location: /manage");
    }
}
