<?php

//initialize page variables
$title = "Create an exercise";
$navTitle = "New exercise";
$navColor = "orange";

ob_start();
?>
    <div class="container">
        <h1>New Exercise</h1>
        <form method="POST">
            <label for="title">Title</label>
            <input type="text" name="ex-name" maxlength="96" <?= empty($error_name) ? "" : "class='error'" ?>>
            <?php
            if (!empty($error_name)) { ?>
                <span class="error-msg"><?= $error_name ?></span>
                <?php
            } ?>


            <input type="submit" value="Create exercise" class="btn bg-purple">
        </form>
    <div>
<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
