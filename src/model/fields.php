<?php

use model\class\DbConnector;

// load database connector
require_once __DIR__ . "/DbConnector.php";

function getAllFieldsByExercise($exerciseID) : array
{
    echo $_ENV['DATABASE_HOST'];
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    //get all exercises
    $resultQuery = $bd->Query(
        "SELECT name FROM exercises WHERE id = ". $exerciseID ." ORDER BY id DESC;"
    );

    //check if result is empty
    if (!$resultQuery) {
        return [];
    }

    //refactor result for view
    foreach ($resultQuery as $exercise) {
        $result[] = $exercise->name;
    }

    return $result;


}

function createField($fieldName,$fieldType,$fieldExercise)
{

}