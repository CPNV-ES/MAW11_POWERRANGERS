<?php

namespace App\Model\Service;

use Exception;

class Exercises
{
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
     * Used to get all exercises
     * @return array
     * @throws Exception
     */
    public static function getAllExercises(): array
    {
        $bd = self::DBConnection();

        $query = "SELECT name, status, id FROM exercises ORDER BY id DESC;";

        //get all exercises
        $resultQuery = $bd->query($query);

        //check if result is empty
        if (!$resultQuery) {
            return [];
        }

        //refactor result for view
        foreach ($resultQuery as $exercise) {
            $result[] = ['name' => $exercise->name, 'status' => $exercise->status, 'id' => $exercise->id];
        }

        return $result;
    }

    /**
     * Used to create an exercise
     * @param $name - name of the exercise
     * @return int - ID of the exercise
     * @throws Exception
     */
    public static function createExercise($name): int
    {
        $bd = self::DBConnection();

        $query = "INSERT INTO exercises (name, status) values (:name, 'Building')";
        $queryParams = ['name' => $name];

        return $bd->queryReturnId($query, $queryParams);
    }

    /**
     * Get an exercise by passing his id
     * @param $id int
     * @return array
     * @throws Exception
     */
    public static function getExerciseById(int $id): array
    {
        $bd = self::DBConnection();

        $query = "SELECT * FROM exercises WHERE id = " . $id . ";";
        $resultQuery = $bd->query($query);

        //check if result is empty
        if (!$resultQuery) {
            return [];
        }

        //refactor result for view
        foreach ($resultQuery as $exercise) {
            $result["id"] = $exercise->id;
            $result["name"] = $exercise->name;
        }

        return $result;
    }

    /**
     * Used to update Exercise status
     * @param $id
     * @param $status
     * @return void
     * @throws Exception
     */
    public static function updateExerciseStatus($id, $status): void
    {
        $bd = self::DBConnection();

        $query = "UPDATE exercises SET status = :status WHERE id = :id";
        $queryParams = ['status' => $status, 'id' => $id];

        $bd->query($query, $queryParams);
    }

    /**
     * Used to delete Execrise
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function deleteExercise(int $id): void
    {
        $bd = self::DBConnection();

        $query =
            "
            DELETE FROM Exercises 
            WHERE id = :id
        ";
        $queryParams["id"] = $id;
        $bd->Query($query, $queryParams);
    }
}
