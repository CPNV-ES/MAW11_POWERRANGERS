<?php

namespace App\Model\Service;

class Exercises
{
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
     * Used to get all exercises
     * @return array
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
     */
    public static function getExerciseById($id): array
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
}
