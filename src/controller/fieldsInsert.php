<?php

require_once __DIR__."/../model/fields.php";
require_once __DIR__."/../model/fieldsTypes.php";

$fieldName = $_POST["name"];
$fieldType = $_POST["fieldType"];
$fieldExercise = $_POST["exercise"];

createField($fieldName,$fieldType, $fieldExercise);

header( "Location: /exercises/1/fields" );