<?php

//initialize page variables
$title = "Home";
$styles = array("<link rel='stylesheet' href='./css/pages/home.css'>");

ob_start();

$nav = <<<HTML

    <div class="top">
        <img src="./images/logo.png" alt="Exercise looper">
        <span>
            <h1>Exercise</h1>
            <h1>Looper</h1>
        </span>
    </div>
HTML;

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
