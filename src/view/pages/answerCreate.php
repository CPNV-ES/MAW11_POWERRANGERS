<?php

//initialize page variables
$title = "Answer an exercise";
$navTitle = "Exercise: <b>" . $exercise['name'] . "</b>";
$navColor = "purple";
$styles = array("<link rel='stylesheet' href='../../css/pages/exercise-new.css'>");

$test = ['name' => 'teast'];
ob_start();
?>
    <h1>Your take</h1>
    <span>If you'd like to come back later to finish, simply submit it with blanks</span>

    <form method="POST">
        <?php
        array_map(function ($field) {
            switch ($field->length) {
                case 64:
                    $input = '<input type="text" name='.$field->id.'>';
                    break;
                case 128:
                    $input = '<textarea name='.$field->id.'></textarea>';
                    break;
                case 255:
                    $input = '<textarea name='.$field->id.'></textarea>';
                    break;
            }

            echo '<label>' . $field->name . '</label>' . $input;
        }, $fields)
        ?>

        <input type="submit" value="save" class="btn bg-purple">
    </form>
<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
