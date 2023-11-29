<?php

use App\Model\DbConnector;

/**
 * Used to get fields types
 * @return array
 */
function getFieldsTypes(): array
{
    //initialize database connector
    $bd = new DbConnector(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD']
    );
//get all exercises
    $resultQuery = $bd->Query("SELECT * FROM fieldtypes");
//check if result is empty
    if (!$resultQuery) {
        return [];
    }

    //refactor result for view
    foreach ($resultQuery as $types) {
        $result[] = $types;
    }

    return $result;
}
