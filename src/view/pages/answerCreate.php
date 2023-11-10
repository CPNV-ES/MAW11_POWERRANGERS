<?php

//initialize page variables
$title = "Answer an exercise";
$navTitle = "Exercise:";
$navColor = "purple";
$styles = '';

ob_start();
?>
    <h1>Your take</h1>

<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
