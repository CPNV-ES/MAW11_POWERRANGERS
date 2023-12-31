<?php

namespace App\Model\Service;

use Exception;

class Fulfillments
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
     * Used to create a fulfillment
     * @return int - the created id item
     * @throws Exception
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

    /**
     * Used to get fulillments by exercise id
     * @param int $exerciseId
     * @return array
     * @throws Exception
     */
    public static function getFulfillmentsByExerciseId(int $exerciseId): array
    {
        $bd = self::DBConnection();

        $query =
            "
            SELECT DISTINCT f.id AS fulfillment_id, f.dateTime
                FROM `exercise-looper`.`fulfillments` AS f
                JOIN `exercise-looper`.`answers` AS a ON f.id = a.fulfillments_id
                JOIN `exercise-looper`.`fields` AS fld ON a.fields_id = fld.id
                JOIN `exercise-looper`.`exercises` AS e ON fld.exercises_id = e.id
                WHERE e.id = (?);
            ";
        $queryParams = [$exerciseId];
        return $bd->query($query, $queryParams);
    }

    /**
     * Used to get fulliments by id
     * @param int $fulfillmentId
     * @return array
     * @throws Exception
     */
    public static function getFulfillmentById(int $fulfillmentId): array
    {
        $bd = self::DBConnection();

        $query =
            "
                SELECT * FROM fulfillments
                WHERE id = ?;
            ";
        $queryParams = [$fulfillmentId];
        return $bd->query($query, $queryParams);
    }
}
