<?php

namespace App\Model\Service;

class Fulfillments
{
    /**
     * Used to create a db connection
     * @return DbConnector
     */
    private static function DBConnection(): DbConnector
    {
        return $bd = new DbConnector(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_NAME'],
            $_ENV['DATABASE_USERNAME'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    /**
     * Used to create a fulfillment
     * @return int - the created id item
     */
    public static function createFulfillment(): int
    {
        $bd = self::DBConnection();

        $query =
            "
                INSERT INTO fulfillments (dateTime) 
                values (?);
            ";
        $queryParams = [gmdate("Y-m-d H:i:s")];
        return $bd->queryReturnId($query, $queryParams);
    }
}
