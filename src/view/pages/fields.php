

<?php

//initialize page variables
$title = "Exercises";
$navTitle = "New exercise";
$navColor = "orange";
$navTitle = $exercise["name"];

require_once SOURCE_DIR . '/view/components/fieldRow.php';

ob_start();
?>
<div class="container">
    <div class="row">
        <section class="col-sm">
            <h1>Fields</h1>
            <table class="records table">
                <thead>
                <tr>
                    <th>Label</th>
                    <th>Value kind</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php
                    foreach ($fields as $field) {
                        row($field, $this->variables['exerciseId']);
                    }
                 ?>
                </tbody>
            </table>
            <button type="button" class="btn bg-purple">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chat-fill" viewBox="0 0 16 16">
                    <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z"/>
                </svg>
                Complete and be ready for answers
            </button>
        </section>

        <section class="col-sm">
            <h1>New Field</h1>
            <form action="/exercises/<?= $this->variables['exerciseId'] ?>/fields" method="post">
                <div class="field">
                    <label for="name">Label</label><br>
                    <input type="text" id="name" name="name" maxlength="512" class="form-control" <?= empty($error_name) ? "" : "class='error'" ?>><br>
                </div>
                <?php
                if (!empty($error_name)) { ?>
                    <span class="error-msg"><?= $error_name ?></span>
                    <?php
                } ?>
                <div class="field">
                    <label for="fieldType">Value kind</label><br>
                    <select id="fieldType" name="fieldType" class="form-control" <?= empty($error_select) ? "" : "class='error'" ?>>
                        <?php
                        foreach ($fieldsTypes as $type): ?>
                            <option value="<?php
                            echo $type->id; ?>">
                                <?php
                                echo $type->name; ?>
                            </option>
                        <?php
                        endforeach; ?>
                    </select><br>
                    <?php
                    if (!empty($error_select)) { ?>
                        <span class="error-msg"><?= $error_select ?></span>
                        <?php
                    } ?>
                </div>

                <input type="submit" value="Submit" class="btn bg-purple">
            </form>
        </section>
    </div>
</div>

<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
