<?php

// load model for exercises
require_once SOURCE_DIR . "/model/fulfillments.php";
require_once SOURCE_DIR . "/model/answers.php";

$fulfillment = createFulfillment();
$exerciseId = $this->variables['exerciseId'];

foreach ($_POST as $field => $value) {
    createAnswer($value, $fulfillment, $field);
}

// load view for fulfillment
header("Location: /exercises/" . $exerciseId . "/answer/" . $fulfillment . "/edit");
