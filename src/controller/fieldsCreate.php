<?php

require_once __DIR__."/../model/fields.php";
require_once __DIR__."/../model/fieldsTypes.php";

$fieldName = $_POST["name"];
$fieldType = $_POST["fieldType"];
$fieldExercise = $this->variables['exerciseId'];

if (strlen($fieldName) > 512) {
    $error_name = "The label of your field can't exceed 512 characters";
    http_response_code(406);
    // reload view for create a new exercise
    require_once __DIR__ . "/fields.php";
} elseif ($fieldType == null) {
    $error_select = "The value kind cannot be empty";
    http_response_code(406);
    // reload view for create a new exercise
    require_once __DIR__ . "/fields.php";
}else {
    createField($fieldName,$fieldType, $fieldExercise);
    header( "Location: /exercises/". $this->variables['exerciseId'] ."/fields" );
}
