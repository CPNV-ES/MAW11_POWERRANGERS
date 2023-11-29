<?php

// load model for exercises
require_once SOURCE_DIR . "/model/exercises.php";

$exercises = getAllExercises();

// load view for exercises
require_once SOURCE_DIR . "/view/pages/exercises.php";
