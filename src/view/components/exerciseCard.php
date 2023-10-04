<?php

/**
 * @param string $title
 * @return void
 */
function card(string $title) : void
{
    ?>

    <li class='card'>
        <span class='title'><?= $title ?></span>
        <button class='btn bg-purple'>take it</button>
    </li>

    <?php
}
