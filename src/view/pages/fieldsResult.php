

<?php

//initialize page variables
$title = "Results";
$navTitle = "New exercise";
$navColor = "green";
$navTitle = "Exercise: " . "<strong>" . htmlspecialchars($exercise['name'], ENT_QUOTES, 'UTF-8') . "</strong>";
$styles = ["<link rel='stylesheet' href='/css/pages/fieldsresult.css'>"];

ob_start();
?>
<div class="container">
    <h1 class="question"><?= htmlspecialchars($fields["name"], ENT_QUOTES, 'UTF-8') ?></h1>

    <table>
        <tr>
            <th class="take">Take</th>
            <th class="content">Content</th>
        </tr>
        <?php foreach ($answers as $answer) : ?>
            <tr>
                <td class="take"><a href="/exercises/<?=$exercise["id"]?>/fulfillments/<?=$answer->fulfillments_id?>"><?= $fulfillments[$answer->fulfillments_id]->dateTime . " UTC"; ?></a></td>
                <td class="content"><?= htmlspecialchars($answer->value, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
