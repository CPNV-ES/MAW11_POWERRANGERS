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

?>

    <div class="btn-list">
        <a href="/exercises">
            <button class="btn bg-purple">Take an exercise</button>
        </a>
        <a href="">
            <button class="btn bg-orange">Create an exercise</button>
        </a>
        <a href="">
            <button class="btn bg-green">Manage an exercise</button>
        </a>

    </div>

<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
