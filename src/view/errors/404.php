<?php

$title = "404";
$navColor = "red";
//initialize page variables
$styles = array("<link rel='stylesheet' href='./css/pages/error.css'>");

ob_start();
?>

    <h1>404</h1>
    <span>Oops! It looks like the page you're looking for can't be found.</span>

<?php
$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
