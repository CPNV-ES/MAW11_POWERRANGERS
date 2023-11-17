<?php

use model\class\DbConnector;

// load database connector
require_once SOURCE_DIR . "/model/DbConnector.php";

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

    $res = $bd->queryReturnId($query, $queryParams);
}
