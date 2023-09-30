<?php

require_once "src/model/exercises.php";

$exercises = getAllExercises();

require_once "src/view/pages/exercises.php";