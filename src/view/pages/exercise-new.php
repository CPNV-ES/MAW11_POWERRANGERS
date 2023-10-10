<?php

//initialize page variables
$title = "Create an exercise";
$navTitle = "New exercise";
$navColor = "orange";
//$styles = array("<link rel='stylesheet' href='./css/components/exerciseCard.css'>");

ob_start();
?>
    <h1>New Exercise</h1>
    <form method="POST">
        <label for="title">Title</label>
        <input type="text" name="title">
        <input type="submit" value="Create exercise" class="btn bg-purple">
    </form>
<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
