<?php

function card($title) : void
{
    echo "
        <div class='card'>
            <span class='title'>$title</span>
            <button class='btn bg-purple'>take it</button>
        </div>
    ";
}
