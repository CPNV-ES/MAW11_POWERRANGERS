<?php

use model\class\DbConnector;

require_once __DIR__ . "/DbConnector.php";

function getAllExercises() : array
{
    $bd = new DbConnector($_ENV['DATABASE_HOST'], $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);

    $resultQuery = $bd->Query("SELECT name FROM exercises ORDER BY id DESC;");
    if (!$resultQuery) {
        return [];
    }
    foreach ($resultQuery as $exercise) {
        $result[] = $exercise->name;
    }
    return $result;
}