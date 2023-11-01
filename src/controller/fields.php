<?php

// load model for exercises
require_once __DIR__."/../model/fields.php";
require_once __DIR__."/../model/fieldsTypes.php";

$fields = getFieldsByExercise($this->variables['exerciseId']);
$fieldsTypes = getFieldsTypes();

// load view for exercises
require_once __DIR__."/../view/pages/fields.php";
