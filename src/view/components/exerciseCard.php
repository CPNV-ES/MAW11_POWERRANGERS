<?php

/**
 * @param string $title
 * @return void
 */
function card(array $exercise) : void
{
    ?>

    <li class='card'>
        <span class='card-title'><?= $exercise['name'] ?></span>
        <a href="exercises/<?= $exercise['id'] ?>/answer" class='btn bg-purple'>take it</a>
    </li>

    <?php
}
