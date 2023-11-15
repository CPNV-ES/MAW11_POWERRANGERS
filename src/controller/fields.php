<?php

// load model for exercises
require_once SOURCE_DIR."/model/fields.php";
require_once SOURCE_DIR."/model/fieldsTypes.php";
require_once SOURCE_DIR."/model/exercises.php";

$fields = getFieldsByExercise($this->variables['exerciseId']);
$fieldsTypes = getFieldsTypes();
$exercise = getExerciseById($this->variables['exerciseId']);

// load view for exercises
require_once SOURCE_DIR."/view/pages/fields.php";
