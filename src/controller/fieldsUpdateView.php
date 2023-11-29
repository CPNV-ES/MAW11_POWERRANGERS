<?php

// load model for exercises
require_once SOURCE_DIR . "/model/fields.php";
require_once SOURCE_DIR . "/model/fieldsTypes.php";
require_once SOURCE_DIR . "/model/exercises.php";

$field = getFieldsById($this->variables['fieldId']);
$fieldsTypes = getFieldsTypes();
$exercise = getExerciseById($this->variables['exerciseId']);

// load view for fieldsUpdate
require_once SOURCE_DIR . "/view/pages/fieldsUpdate.php";
