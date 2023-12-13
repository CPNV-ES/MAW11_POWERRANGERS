

<?php

//initialize page variables
$title = "Exercises";
$navTitle = "New exercise";
$navColor = "orange";
$navTitle = "Exercise: " . "<strong>". $exercise["name"] . "</strong>";

ob_start();
?>
<div class="container">
    <h1><?= $fields["name"] ?></h1>

    <table>
        <tr>
            <th>Take</th>
            <th>Content</th>
        </tr>
        <?php foreach ($answers as $answer): ?>
            <tr>
                <td><?= $fulfillments[$answer->fulfillments_id]->dateTime; ?></td>
                <td><?= $answer->value; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
