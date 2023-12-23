<?php

namespace App\Model\Service;

use Exception;

class FieldTypes
{
    /**
     * Used to create a db connection
     * @return DbConnector
     */
    private static function DBConnection(): DbConnector
    {
        return new DbConnector(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_NAME'],
            $_ENV['DATABASE_USERNAME'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    /**
     * Used to get fields types
     * @return array
     * @throws Exception
     */
    public static function getFieldsTypes(): array
    {
        $bd = self::DBConnection();

        //get all exercises
        $resultQuery = $bd->Query("SELECT * FROM fieldTypes");
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
}
