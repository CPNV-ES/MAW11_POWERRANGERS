<?php
$title = "Exercises";
$style = "<link rel='stylesheet' href='./css/pages/exercises.css'>";

require_once dirname(__FILE__) . '/../components/exerciseCard.php';

ob_start();

 array_map('card', $exercises);

$content = ob_get_clean();
require dirname(__FILE__) . "/../layout.php";