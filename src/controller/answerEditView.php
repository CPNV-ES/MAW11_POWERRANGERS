<?php


// load model for exercises
require_once SOURCE_DIR . "/model/exercises.php";
require_once SOURCE_DIR . "/model/fields.php";
require_once SOURCE_DIR . "/model/answers.php";

$exercise = getExerciseById($this->variables['exerciseId']);
//$fields = getFieldsByExercise($this->variables['exerciseId']);
$fields = getAnswersByFulfillment($this->variables['answerId']);
$description = "Bookmark this page, it's yours. You'll be able to come back later to finish.";

// load view for exercises
require_once SOURCE_DIR . "/view/pages/answer.php";
