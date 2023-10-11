<?php

require_once __DIR__ . "/../model/exercises.php";

$name = $_POST["ex-name"];

if (empty($name)) {
    $error_name = "You have to name your exercise";
    // reload view for create a new exercise
    require_once __DIR__ . "/../view/pages/exercise-new.php";

} elseif (strlen($name) > 96) {
    $error_name = "The name of your exercise can't exceed 96 characters";
    // reload view for create a new exercise
    require_once __DIR__ . "/../view/pages/exercise-new.php";
} else {
    createExercise($name);
    require_once __DIR__ . "/../view/pages/home.php";
}

