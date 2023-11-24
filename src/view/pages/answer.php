<?php

//initialize page variables
$title = "Answer an exercise";
$navTitle = "Exercise: <b>" . $exercise['name'] . "</b>";
$navColor = "purple";
$styles = array("<link rel='stylesheet' href='/css/pages/exercise-new.css'>");

ob_start();
?>
    <h1>Your take</h1>
    <span><?= $description ?></span>

    <form method="POST">
        <?php
        foreach ($fields as $field): ?>
            <label><?= $field->name ?></label>

            <?php
            switch ($field->length) {
                case FIELD_SINGLE_LINE:
                    echo '<input type="text" name=' . $field->id . ' value="' . $field->value . '">';
                    break;
                case FIELD_LIST_OF_SINGLE_LINE:
                    echo '<textarea name=' . $field->id . '>' . $field->value . '</textarea>';
                    break;
                case FIELD_MULTI_LINE:
                    echo '<textarea name=' . $field->id . '>' . $field->value . '</textarea>';
                    break;
                default :
                    echo '<input type="text" name=' . $field->id . ' value="' . $field->value . '">';
                    break;
            }
        endforeach;
        ?>

        <input type="submit" value="save" class="btn bg-purple">
    </form>
<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
