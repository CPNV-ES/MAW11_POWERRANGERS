<?php

//initialize page variables
$title = "Exercises";
$style = "<link rel='stylesheet' href='./css/pages/exercises.css'>";

//load card component
require_once __DIR__.'/../components/exerciseCard.php';

ob_start();
<<<<<<< HEAD
?>
<ul>
<?php
 array_map('card', $exercises);
?>
</ul>
<?php
=======

//make cards with data from database
array_map('card', $exercises);

>>>>>>> 3e6334827938d786e663a4384708c46e3b811afc
$content = ob_get_clean();

//load layout
require __DIR__."/../layout.php";