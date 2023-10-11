<?php

//initialize page variables
$title = "Exercises";

//load card component
require_once __DIR__ . '/../components/exerciseCard.php';

ob_start();
?>

    <form action="/">
        <label for="Label">Label</label><br>
        <input type="text" id="Label" name="Label"><br>
        <label for="fieldType">Value kind</label><br>
        <select type="text" id="fieldType" name="fieldType">
        <option></option>
        </select><br>
        <input type="submit" value="Submit">
    </form>

<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
