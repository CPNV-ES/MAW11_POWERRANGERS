<?php

// load model for exercises
require_once __DIR__."/../model/fields.php";

$exercises = getFieldsByExercise();

// load view for exercises
require_once __DIR__."/../view/pages/fields.php";