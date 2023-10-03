<?php

use model\class\DbConnector;

require_once __DIR__ . "/DbConnector.php";

function getAllExercises() {
    $bd = new DbConnector($_ENV['DATABASE_HOST'], $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);

    $resultQuery = $bd->Query("SELECT name FROM exercises ORDER BY id DESC;");
    foreach ($resultQuery as $exercise) {
        $result[] = $exercise->name;
    }
    return $result;
}