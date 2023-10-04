<?php

<<<<<<< HEAD
$title = "500";
=======
//initialize page variables
$title = "404";
>>>>>>> 3e6334827938d786e663a4384708c46e3b811afc
$style = "<link rel='stylesheet' href='./css/pages/error.css'>";

ob_start();
?>

    <h1>500</h1>
    <span>Oh no! Something went wrong on our end. We're working to fix it as soon as possible. In the meantime, you can try refreshing the page or come back later.</span>

<?php
$content = ob_get_clean();

//load layout
require __DIR__ . "/../layout.php";
