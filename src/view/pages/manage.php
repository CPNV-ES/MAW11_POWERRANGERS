<?php

//initialize page variables
$title = "Manage exercises";
$navColor = "green";

ob_start();
?>

<?php
$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
