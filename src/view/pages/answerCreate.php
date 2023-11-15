<?php

//initialize page variables
$title = "Answer an exercise";
$navTitle = "Exercise: <b>". $exercise['name'] ."</b>";
$navColor = "purple";
$styles = array("<link rel='stylesheet' href='../../css/pages/exercise-new.css'>");

ob_start();
?>
    <h1>Your take</h1>
    <span>If you'd like to come back later to finish, simply submit it with blanks</span>

    <form action="">
        <label>Décriver le polymorphisme</label>
        <input type="text">
        <label>Décriver le polymorphisme</label>
        <input type="text">
        <label>Décriver le polymorphisme</label>
        <input type="text">

        <input type="submit" value="save" class="btn bg-purple">
    </form>
<?php

$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
