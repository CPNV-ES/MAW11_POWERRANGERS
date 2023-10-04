<?php

$title = "500";
$style = "<link rel='stylesheet' href='./css/pages/error.css'>";

ob_start();
?>

    <h1>500</h1>
    <span>Oh no! Something went wrong on our end. We're working to fix it as soon as possible. In the meantime, you can try refreshing the page or come back later.</span>

<?php
$content = ob_get_clean();
require __DIR__ . "/../layout.php";
