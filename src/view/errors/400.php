<?php

$title = "404";
$navColor = "red";
//initialize page variables
$styles = ["<link rel='stylesheet' href='/css/pages/error.css'>"];

ob_start();
?>

    <h1>400</h1>
    <span>Oops! It looks like the request parameters isn't right.</span>

<?php
$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
