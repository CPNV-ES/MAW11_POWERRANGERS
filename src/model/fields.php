<?php

use model\class\DbConnector;

// load database connector
require_once SOURCE_DIR . "/model/DbConnector.php";

/**
 * @param int $exerciseID
 * @return array
 */
function getFieldsByExercise($exerciseId) : array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "SELECT f.name AS name, ft.name AS type FROM fields f JOIN fieldTypes ft ON f.fieldTypes_id = ft.id WHERE f.exercises_id = :exercise_id";
    $queryParams["exercise_id"] = $exerciseId;

    //get all exercises
    $resultQuery = $bd->Query($query, $queryParams);

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
 * Create a field
 *
 * @param $fieldName string name
 * @param $fieldTypeId int type id associeted
 * @param $exerciseId int exercise id associeted
 * @return int associeted
 */
function createField($fieldName,$fieldTypeId,$exerciseId)
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "insert into fields (name, exercises_id, fieldTypes_id) values (:name,:exercises_id,:fieldTypes_id)";
    $queryParams = array(
        'name' => $fieldName,
        'exercises_id' => $exerciseId,
        'fieldTypes_id' => $fieldTypeId
    );

    return $bd->queryReturnId($query, $queryParams);
}

/**
 * delete a field
 *
 * @param $id int
 * @return string result
 */
function deleteField(int $id)
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "DELETE FROM fields WHERE id = :id";
    $queryParams["id"] = $id;
    $bd->Query($query, $queryParams);
}