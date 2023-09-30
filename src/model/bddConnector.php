<?php

function dbConnector(){


    $dbHost = $_ENV['DATABASE_HOST'];
    $dbName = $_ENV['DATABASE_NAME'];
    $dbUser = $_ENV['DATABASE_USERNAME'];
    $dbPass = $_ENV['DATABASE_PASSWORD'];

    $connexion = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8",
        $dbUser,
        $dbPass
    );

    return $connexion;

}

