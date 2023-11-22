

<?php

//initialize page variables
$title = "Exercises";
$navTitle = "New exercise";
$navColor = "orange";
$navTitle = "Exercise: " . "<strong>". $exercise["name"] . "</strong>";

$styles = array("<link rel='stylesheet' href='/css/pages/fields.css'>");
ob_start();
?>
<div class="container">
    <h1>Editing Field</h1>

    <form action="/exercises/<?= $this->variables['exerciseId'] ?>/fields" method="post">
        <!-- Name of the field  -->
        <div class="field">
            <label for="name">Label</label><br>
            <input type="text"
                   id="name"
                   name="name"
                   maxlength="512"
                   class="form-control"
                   <?= empty($error_name) ? "" : "class='error'" ?> value="<?= $field["name"] ?>"
            >
            <br>

            <?php if (!empty($error_name)) : ?>
                <span class="error-msg"><?= $error_name ?></span>
            <?php endif; ?>
        </div>
        <!-- Type of the field  -->
        <div class="field">
            <label for="fieldType">Value kind</label><br>
            <select id="fieldType"
                    name="fieldType"
                    class="form-control"
                    <?= empty($error_select) ? "" : "class='error'" ?>
            >

                <?php foreach ($fieldsTypes as $type): ?>
                    <option value="<?= $type->id; ?>"
                        <?php if ($type->name == $field["type"]) : ?>
                        selected="selected">
                        <?php else: ?>
                            >
                        <?php endif;?>
                        <?= $type->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <?php if (!empty($error_select)) : ?>
                <span class="error-msg"><?= $error_select ?></span>
            <?php endif; ?>
        </div>

        <input type="submit" value="Submit" class="btn bg-purple">
    </form>
</div>

<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
