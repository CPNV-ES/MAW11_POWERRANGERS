<?php

// load model for exercises
require_once __DIR__."/../model/fields.php";
require_once __DIR__."/../model/fieldsTypes.php";
require_once __DIR__."/../model/exercises.php";

$fields = getFieldsByExercise($this->variables['exerciseId']);
$fieldsTypes = getFieldsTypes();
$exercise = getExerciseById($this->variables['exerciseId']);

// load view for exercises
require_once __DIR__."/../view/pages/fields.php";
