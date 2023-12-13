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
                                <td class="text-section"><?= $exercise['name'] ?></td>
                                <td class="icon-section">

                                    <?php
                                    if ($exercise['fieldsCount'] > 0) : ?>
                                        <a class="fa-solid fa-comment" title="Edit" rel="nofollow" data-method="PUT"
                                           href="/exercises/<?= $exercise['id'] ?>/status?status=Answering"></a>
                                        <?php
                                    endif; ?>

                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <i class="fa-solid fa-trash"></i>
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
                                <td class="text-section"><?= $exercise['name'] ?></td>
                                <td class="icon-section">
                                    <i class="fa-solid fa-chart-column"></i>
                                    <a data-method="PUT" href="/exercises/<?= $exercise['id'] ?>/status?status=Closed"  class="fa-solid fa-circle-minus"></a>
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
                                <td class="text-section"><?= $exercise['name'] ?></td>
                                <td class="icon-section">
                                    <i class="fa-solid fa-chart-column"></i>
                                    <i class="fa-solid fa-trash"></i>
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