

<?php

//initialize page variables
$title = "Exercises";
$navTitle = "New exercise";
$navColor = "orange";
$navTitle = "Exercise: " . "<strong>" . $exercise["name"] . "</strong>";
$styles = array("<link rel='stylesheet' href='/css/pages/fields.css'>");
ob_start();
?>
<div class="container">
    <!-- Left side with list of fields  -->
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
                <?php foreach ($fields as $field) : ?>
                    <tr>
                        <td class="fieldsTitle align-middle"><?= $field->name; ?></td>
                        <td class="text-nowrap align-middle"><?= $field->type; ?></td>
                        <td class="align-middle">
                            <a
                               title="Edit"
                               class="icon fa-solid fa-pen-to-square"
                               rel="nofollow"
                               data- ="GET"
                               href="/exercises/<?= $this->variables['exerciseId']; ?>/fields/<?= $field->id ?>"
                            >


                            </a>
                            <a data-confirm="Are you sure?"
                               title="Destroy"
                               class="icon"
                               rel="nofollow"
                               data-method="delete"
                               href="/exercises/<?= $this->variables['exerciseId']; ?>/fields/<?= $field->id ?>/delete"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-trash-fill" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php
                endforeach; ?>
                </tbody>
            </table>

            <a class="btn bg-purple" data-confirm="Are you sure? You won't be able to further edit this exercise" data-method="PUT" href="/exercises/<?= $this->variables['exerciseId'] ?>/status?status=Answering">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chat-fill" viewBox="0 0 16 16">
                    <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z"/>
                </svg>
                Complete and be ready for answers
            </a>
        </section>

        <!-- Right side with the add field form  -->
        <section class="col-sm">
            <h1>New Field</h1>

            <form action="/exercises/<?= $this->variables['exerciseId'] ?>/fields" method="post">
                <!-- Left side with list of fields  -->
                <!-- Name of the field  -->
                <div class="field">
                    <label for="name">Label</label>
                    <input type="text"
                           id="name"
                           name="name"
                           maxlength="512"
                           class="form-control" <?= empty($error_name) ? "" : "class='error'" ?>
                    >

                    <?php if (!empty($error_name)) : ?>
                        <span class="error-msg">
                        <?= $error_name ?>
                    </span>
                    <?php endif;?>
                </div>
                <!-- Type of the field  -->
                <div class="field">
                    <label for="fieldType">Value kind </label>
                    <br>
                    <select id="fieldType"
                            name="fieldType"
                            class="form-control" <?= empty($error_select) ? "" : "class='error'" ?>
                    >
                        <?php foreach ($fieldsTypes as $type) : ?>
                            <option value="<?= $type->id; ?>">
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
        </section>
    </div>
</div>

<?php

$content = ob_get_clean();

//load layout
require SOURCE_DIR . "/view/layout.php";
