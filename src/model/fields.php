<?php

use model\class\DbConnector;

// load database connector
require_once SOURCE_DIR . "/model/DbConnector.php";

/**
 * @param $exerciseID
 * @return array
 */
function getFieldsByExercise($exerciseID) : array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    //get all exercises
    $resultQuery = $bd->Query(
        "SELECT f.name AS name, ft.name AS type FROM fields f JOIN fieldTypes ft ON f.fieldTypes_id = ft.id WHERE f.exercises_id = " . $exerciseID . ";"
    );

    //check if result is empty
    if (!$resultQuery) {
        return [];
    }

    //refactor result for view
    foreach ($resultQuery as $exercise) {
        $result[] = $exercise;
    }

    return $result;
}

/**
 * @param $fieldName
 * @param $fieldTypeId
 * @param $exerciseId
 * @return array|false
 */
function createField($fieldName,$fieldTypeId,$exerciseId)
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "insert into fields (name, exercises_id, fieldTypes_id) values (?)";
    $queryParams = [$fieldName, $exerciseId, $fieldTypeId];

    return $bd->queryReturnId($query, $queryParams);
}
