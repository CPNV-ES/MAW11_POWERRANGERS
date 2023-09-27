<?php
$title = "Exercises";
$style = "<link rel='stylesheet' href='/../src/view/exercises/exercises.css'>";

require_once dirname(__FILE__).'/../components/exerciseCard.php';

//HARD exercises
$exercises = ["a", "Linux base commands", "CLD2 Cloud Services"];
ob_start();
?>

<?php array_map('card', $exercises)?>
<?php echo dirname(__FILE__)?>


<?php
$content = ob_get_clean();
require dirname(__FILE__)."/../layout.php";
?>
