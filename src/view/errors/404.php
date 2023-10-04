<?php

<<<<<<< HEAD
$title = "404";
=======
//initialize page variables
$title = "500";
>>>>>>> 3e6334827938d786e663a4384708c46e3b811afc
$style = "<link rel='stylesheet' href='./css/pages/error.css'>";

ob_start();
?>

    <h1>404</h1>
    <span>Oops! It looks like the page you're looking for can't be found.</span>

<?php
$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
