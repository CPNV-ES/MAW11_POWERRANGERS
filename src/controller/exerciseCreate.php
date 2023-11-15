<?php

require_once SOURCE_DIR . "/model/exercises.php";

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
    $exerciseId = createExercise($name);
    header("Location: /exercises/" . $exerciseId . "/fields");
}
