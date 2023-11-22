<?php

// load model for exercises
require_once SOURCE_DIR."/model/exercises.php";
require_once SOURCE_DIR."/model/fields.php";

$exercise = getExerciseById($this->variables['exerciseId']);
$fields = getFieldsByExercise($this->variables['exerciseId']);
$description = "If you'd like to come back later to finish, simply submit it with blanks";

// load view for exercises
require_once SOURCE_DIR . "/view/pages/answer.php";
