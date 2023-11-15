<?php

// load model for exercises
require_once SOURCE_DIR."/model/exercises.php";

$exercise = getExerciseById($this->variables['exerciseId']);

// load view for exercises
require_once SOURCE_DIR."/view/pages/answerCreate.php";
