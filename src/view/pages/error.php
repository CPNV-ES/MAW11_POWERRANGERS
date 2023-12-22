<?php

$title = http_response_code();
$navColor = "red";
//initialize page variables
$styles = ["<link rel='stylesheet' href='/css/pages/error.css'>"];

ob_start();
?>

    <h1><?=http_response_code() ?></h1>
    <span><?=$this->variables["errorMessage"] ?></span>

<?php
$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
