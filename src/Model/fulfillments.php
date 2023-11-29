<?php

use App\Model\DbConnector;

/**
 * Used to create a fulfillment
 * @return int - the created id item
 */
function createFulfillment(): int
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
            INSERT INTO fulfillments (dateTime) 
            values (?);
        ";
    $queryParams = [gmdate("Y-m-d H:i:s")];
    return $bd->queryReturnId($query, $queryParams);
}
