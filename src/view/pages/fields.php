<?php

//initialize page variables
$title = "Exercises";
$styles = array("<link rel='stylesheet' href='./css/components/exerciseCard.css'>");

ob_start();
?>
    <form action="/">
        <label for="Label">Label</label><br>
        <input type="text" id="Label" name="Label"><br>

        <label for="fieldType">Value kind</label><br>
        <select id="fieldType" name="fieldType">
            <?php foreach ($fieldsTypes as $type): ?>
                <option value="<?php echo $type; ?>">
                    <?php echo $type; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
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
