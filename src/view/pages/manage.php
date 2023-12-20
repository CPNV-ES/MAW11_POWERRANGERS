<?php

//initialize page variables
$title = "Manage exercises";
$navColor = "green";
$styles = array("<link rel='stylesheet' href='/css/pages/manage.css'>");

ob_start();
?>

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="row"><h1 class="col-header">Building</h1></div>
                <div class="row">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                        <?php
                        foreach ($exercises_building as $exercise) : ?>
                            <tr>
                                <td class="text-section"><?= htmlspecialchars($exercise['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="icon-section">

                                    <?php
                                    if ($exercise['fieldsCount'] > 0) : ?>
                                        <a class="fa-solid fa-comment" title="Be ready for answers" rel="nofollow"
                                           data-method="PUT"
                                           href="/exercises/<?= $exercise['id'] ?>/status?status=Answering"></a>
                                        <?php
                                    endif; ?>

                                    <a title="Manage fields" class="fa-solid fa-pen-to-square" rel="nofollow" href="/exercises/<?= $exercise['id'] ?>/fields"></a>
                                    <a title="Destroy" class="fa-solid fa-trash" rel="nofollow" data-confirm="Are you sure?" data-method="DELETE"
                                       href="/exercises/<?= $exercise['id'] ?>"></a>
                                    <i></i>
                                </td>
                            </tr>
                            <?php
                        endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="col">

                <div class="row"><h1 class="col-header">Answering</h1></div>
                <div class="row">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                        <?php
                        foreach ($exercises_answering as $exercise) : ?>
                            <tr>
                                <td class="text-section"><?= htmlspecialchars($exercise['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="icon-section">
                                    <a title="Show results" href="/exercises/<?= $exercise['id'] ?>/results"
                                       class="fa-solid fa-chart-column"></a>

                                    <a title="Close" data-method="PUT"
                                       href="/exercises/<?= $exercise['id'] ?>/status?status=Closed"
                                       class="fa-solid fa-circle-minus"></a>
                                </td>
                            </tr>
                            <?php
                        endforeach; ?>
                    </table>
                </div>
            </div>

            <div class="col">
                <div class="row"><h1 class="col-header">Closed</h1></div>
                <div class="row">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                        <?php
                        foreach ($exercises_closed as $exercise) : ?>
                            <tr>
                                <td class="text-section"><?= htmlspecialchars($exercise['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="icon-section">
                                    <a title="Show results" href="/exercises/<?= $exercise['id'] ?>/results"
                                       class="fa-solid fa-chart-column"></a>

                                    <a title="Destroy" class="fa-solid fa-trash" rel="nofollow" data-confirm="Are you sure?" data-method="DELETE"
                                       href="/exercises/<?= $exercise['id'] ?>"></a>
                                </td>
                            </tr>
                            <?php
                        endforeach; ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

<?php
$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
