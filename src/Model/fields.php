<?php

use App\Model\Service\DbConnector;

/**
 * Get fields by exercise
 * @param int $exerciseId
 * @return array - array of fields
 */
function getFieldsByExercise(int $exerciseId): array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query =
        "
            SELECT f.name AS name, f.id AS id, ft.name AS type, ft.maxLength AS length FROM fields f 
            JOIN fieldTypes ft ON f.fieldTypes_id = ft.id 
            WHERE f.exercises_id = :exercise_id
        ";
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
 * Get fields by exercise
 * @param int $exerciseId
 * @return array - array of fields
 */
function getFieldsById(int $fieldId): array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query =
        "
            SELECT f.id AS id, f.name AS name, ft.name AS type 
            FROM fields f 
            JOIN fieldTypes ft ON f.fieldTypes_id = ft.id 
            WHERE f.id = :field_id
        ";
    $queryParams["field_id"] = $fieldId;

    //get all exercises
    $resultQuery = $bd->Query($query, $queryParams);

    //check if result is empty
    if (!$resultQuery) {
        return [];
    }

    //refactor result for view
    foreach ($resultQuery as $field) {
        $result["id"] = $field->id;
        $result["name"] = $field->name;
        $result["type"] = $field->type;
    }

    return $result;
}

/**
 * Used to create a field
 * @param $fieldName string name
 * @param $fieldTypeId int type id associated
 * @param $exerciseId int exercise id associated
 * @return int associated
 */
function createField(string $fieldName, int $fieldTypeId, int $exerciseId): int
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query =
        "
            insert into fields (name, exercises_id, fieldTypes_id) 
            values (:name,:exercises_id,:fieldTypes_id)
        ";
    $queryParams = [
        'name' => $fieldName,
        'exercises_id' => $exerciseId,
        'fieldTypes_id' => $fieldTypeId
    ];

    return $bd->queryReturnId($query, $queryParams);
}

/**
 * Used to delete a field
 * @param $id int
 * @return void
 */
function updateField(string $fieldName, int $fieldTypeId, int $exerciseId): int
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query =
        "
            UPDATE fields 
            SET name = :name, fieldTypes_id = :fieldTypes_id 
            WHERE (id = :exercises_id);
        ";
    $queryParams = [
        'name' => $fieldName,
        'exercises_id' => $exerciseId,
        'fieldTypes_id' => $fieldTypeId
    ];

    return $bd->queryReturnId($query, $queryParams);
}

/**
 * Used to delete a field
 * @param $id int
 * @return void
 */
function deleteField(int $id): void
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query =
        "
            DELETE FROM fields 
            WHERE id = :id
        ";
    $queryParams["id"] = $id;
    $bd->Query($query, $queryParams);
}
