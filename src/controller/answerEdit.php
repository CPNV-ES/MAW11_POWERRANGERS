<?php

// load model for exercises
require_once SOURCE_DIR . "/model/answers.php";

$exerciseId = $this->variables['exerciseId'];
$answerId = $this->variables['answerId'];

foreach ($_POST as $field => $value) {
    updateAnswer($value, $field);
}

// load view for exercises
header("Location: /exercises/".$exerciseId."/answer/".$answerId."/edit");
