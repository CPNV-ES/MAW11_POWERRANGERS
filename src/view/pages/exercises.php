<?php
$title = "Exercises";
$style = "<link rel='stylesheet' href='./css/pages/exercises.css'>";

require_once __DIR__.'/../components/exerciseCard.php';

ob_start();
?>
<ul>
<?php
 array_map('card', $exercises);
?>
</ul>
<?php
$content = ob_get_clean();
require __DIR__."/../layout.php";