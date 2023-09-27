<?php

function dbConnector() {

    $connexion = new mysqli(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_PORT']
    );

    if ($connexion->connect_error) {
        die("Connection failed: " . $connexion->connect_error);
    }
    echo "Connected successfully";

}

