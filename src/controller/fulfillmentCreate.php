<?php

// load model for exercises
//require_once SOURCE_DIR."/model/exercises.php";
//require_once SOURCE_DIR."/model/fields.php";
//
//$exercise = getExerciseById($this->variables['exerciseId']);
//$fields = getFieldsByExercise($this->variables['exerciseId']);

foreach ($_POST as $answer=> $value){
//    var_dump($answer);
//    var_dump($value);
    $test+=$answer;
}

// load view for exercises
require_once SOURCE_DIR."/view/pages/answerCreate.php";
