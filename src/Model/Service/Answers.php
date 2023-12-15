<?php

namespace App\Model\Service;

class Answers
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
     * Used to create an answer
     * @param $value
     * @param $fulfillment
     * @param $field
     * @return void
     */
    public static function createAnswer(string $value, int $fulfillment, int $field): void
    {
        $bd = self::DBConnection();

        $query = "
                    INSERT INTO answers (value, fields_id, fulfillments_id) 
                    values (:value, :fields_id, :fulfillments_id)
                ";

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
    public static function updateAnswer(string $value, int $fieldId): void
    {
        $bd = self::DBConnection();

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
    public static function getAnswersByFulfillment(int $answerId): array
    {
        $bd = self::DBConnection();

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

    public static function getAnswersByField(int $fieldId): array
    {
        $bd = self::DBConnection();

        $query = "SELECT * FROM answers WHERE fields_id =(?);";
        $queryParams = [$fieldId];
        return $bd->query($query, $queryParams);
    }
}
