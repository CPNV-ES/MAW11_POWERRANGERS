<?php

//initialize page variables
$title = "Exercises";
$styles = array("<link rel='stylesheet' href='./css/components/exerciseCard.css'>");

ob_start();
// TODO : update to have dynamic values
?>
    <form action="/exercises/1/fields" method="post">
        <label for="name">Label</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="fieldType">Value kind</label><br>
        <select id="fieldType" name="fieldType">
            <?php foreach ($fieldsTypes as $type): ?>
                <option value="<?php echo $type->id; ?>">
                    <?php echo $type->name; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="hidden" name="exercise" value="1">
        <input type="submit" value="Submit">
    </form>

    <?php
        foreach ($fields as $field){
            echo $field->name;
            echo $field->type;
        }
    ?>


<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
