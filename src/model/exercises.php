<?php

use model\class\DbConnector;

// load database connector
require_once SOURCE_DIR . "/model/DbConnector.php";

/**
 * @return array
 */
function getAllExercises(): array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "SELECT name, id FROM exercises ORDER BY id DESC;";

    //get all exercises
    $resultQuery = $bd->query($query);

    //check if result is empty
    if (!$resultQuery) {
        return [];
    }

    //refactor result for view
    foreach ($resultQuery as $exercise) {
        $result[] = ['name' => $exercise->name, 'id' => $exercise->id];
    }

    return $result;
}


function createExercise($name): int
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "INSERT INTO exercises (name) values (?)";
    $queryParams = [$name];

    return $bd->queryReturnId($query, $queryParams);
}

/**
 * Get an exercise by passing his id
 *
 * @param $id integer
 * @return array
 */
function getExerciseById($id): array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "SELECT * FROM exercises WHERE id = " . $id . ";";
    $resultQuery = $bd->query($query);

    //check if result is empty
    if (!$resultQuery) {
        return [];
    }

    //refactor result for view
    foreach ($resultQuery as $exercise) {
        $result["id"] = $exercise->id;
        $result["name"] = $exercise->name;
    }

    return $result;
}
