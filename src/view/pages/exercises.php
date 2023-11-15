<?php

//initialize page variables
$title = "Exercises";
$navColor = "purple";
$styles = array("<link rel='stylesheet' href='/css/components/exerciseCard.css'>");

//load card component
require_once SOURCE_DIR . '/view/components/exerciseCard.php';

ob_start();
?>
    <ul>
        <?php

        //make cards with data from database
        array_map('card', $exercises);
        ?>

    </ul>
<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
