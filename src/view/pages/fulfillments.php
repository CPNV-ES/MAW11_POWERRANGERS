<?php

//initialize page variables
$title = "Fullfillments";
$navColor = "green";
$navTitle = "Exercise: " . "<strong>" . htmlspecialchars($exercise['name'], ENT_QUOTES, 'UTF-8') . "</strong>";
$styles = ["<link rel='stylesheet' href='/css/pages/fulfillments.css'>"];
ob_start();
?>
    <div class="container">
        <h1><?=$fulfillment->dateTime?></h1>
        <dl>
            <?php foreach ($answers as $answer) : ?>
                <dt><?= $answer->name; ?></dt>
                <dd><?= $answer->value; ?></dd>
            <?php endforeach; ?>
        </dl>
    </div>
<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
