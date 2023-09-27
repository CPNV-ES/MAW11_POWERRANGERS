<?php
$title = "Exercises";
$style = "<link rel='stylesheet' href='/src/view/exercises/exercises.css'>";

require_once '../components/exerciseCard.php';

//HARD exercises
$exercises = ["a", "Linux base commands", "CLD2 Cloud Services"];
ob_start();
?>

<?php array_map('card', $exercises)?>


<?php
$content = ob_get_clean();
require "../layout.php";
?>
