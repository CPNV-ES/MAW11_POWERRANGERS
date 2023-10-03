<?php

require_once __DIR__."/../model/exercises.php";

$exercises = getAllExercises();

require_once __DIR__."/../view/pages/exercises.php";