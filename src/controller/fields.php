<?php

// load model for exercises
require_once SOURCE_DIR."/model/fields.php";
require_once SOURCE_DIR."/model/fieldsTypes.php";

$fields = getFieldsByExercise($this->variables['exerciseId']);
$fieldsTypes = getFieldsTypes();

// load view for exercises
require_once SOURCE_DIR."/view/pages/fields.php";
