<?php

//initialize page variables
$title = "Exercises";
$navColor = "purple";
$styles = [];
ob_start();
?>
    <ul>

        <!--make cards with data from database-->
        <?php
        foreach ($exercises as $exercise) : ?>
            <li class='card'>
                <span class='card-title'><?= $exercise['name'] ?></span>
                <a href="/exercises/<?= $exercise['id'] ?>/answer" class='btn bg-purple'>take it</a>
            </li>
            <?php
        endforeach; ?>

    </ul>
<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
