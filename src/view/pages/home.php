<?php

//initialize page variables
$title = "Home";
$styles = ["<link rel='stylesheet' href='/css/pages/home.css'>"];

ob_start();

$nav = <<<HTML

    <div class="top">
        <img src="/images/logo.png" alt="Exercise looper">
        <span>
            <h1>Exercise</h1>
            <h1>Looper</h1>
        </span>
    </div>
HTML;
?>

    <div class="btn-list">
        <a href="/exercises" class="btn bg-purple">
            Take an exercise
        </a>

        <a href="/exercises/new" class="btn bg-orange">
            Create an exercise
        </a>

        <a href="/manage" class="btn bg-green">
            Manage an exercise
        </a>

    </div>

<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
