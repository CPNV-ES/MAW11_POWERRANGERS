<?php
$title = "Exercises";
$style = "<link rel='stylesheet' href='./css/pages/exercises.css'>";

require_once __DIR__.'/../components/exerciseCard.php';

ob_start();

 array_map('card', $exercises);

$content = ob_get_clean();
require __DIR__."/../layout.php";