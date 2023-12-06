<?php

$title = "500";
$navColor = "red";
//initialize page variables
$styles = ["<link rel='stylesheet' href='".BASE_DIR."/public/css/pages/error.css'>"];

ob_start();
?>

    <h1>500</h1>
    <span>Oh no! Something went wrong on our end. We're working to fix it as soon as possible. In the meantime, you can try refreshing the page or come back later.</span>

<?php
$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
