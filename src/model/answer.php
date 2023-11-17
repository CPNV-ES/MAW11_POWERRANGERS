<?php
use model\class\DbConnector;

// load database connector
require_once SOURCE_DIR . "/model/DbConnector.php";

function createAnswer($value, $fullfilment, $field): void
{
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );

    $query = "INSERT INTO answers (value, fields_id, fulfillments_id) values (?)";
    $queryParams = [$value, $fullfilment, $field];

    //create new answer
    $bd->queryReturnId($query, $queryParams);
}
