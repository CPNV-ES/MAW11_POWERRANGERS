<?php

// load model for exercises
require_once __DIR__."/../model/exercises.php";

$exercises = getAllExercises();

// load view for exercises
require_once __DIR__."/../view/pages/exercises.php";