<?php

use App\Model\Service\DbConnector;

/**
 * Used to create an answer
 * @param $value
 * @param $fulfillment
 * @param $field
 * @return void
 */
function createAnswer($value, $fulfillment, $field): void
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "INSERT INTO answers (value, fields_id, fulfillments_id) values (:value, :fields_id, :fulfillments_id)";
    $queryParams = [
        'value' => $value,
        'fields_id' => $field,
        'fulfillments_id' => $fulfillment
    ];

    $bd->query($query, $queryParams);
}

/**
 * Used to update answer
 * @param $value
 * @param $fieldId
 * @return void
 */
function updateAnswer($value, $fieldId): void
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "UPDATE answers SET value = :value WHERE id = :id";
    $queryParams = [
        'value' => $value,
        'id' => $fieldId
    ];

    $bd->query($query, $queryParams);
}

/**
 * Used to get all answer by fulfillment id
 * @param int $answerId
 * @return array
 */
function getAnswersByFulfillment(int $answerId): array
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query =
        "
            SELECT a.value AS value,f.name AS name, a.id AS id,ft.name AS type,ft.maxLength AS length FROM answers a 
            JOIN fields f ON a.fields_id = f.id 
            JOIN fieldTypes ft ON f.fieldTypes_id = ft.id 
            WHERE a.fulfillments_id =(?);
        ";
    $queryParams = [$answerId];
    return $bd->query($query, $queryParams);
}
