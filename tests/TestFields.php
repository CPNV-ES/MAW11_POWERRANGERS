<?php

use PHPUnit\Framework\TestCase;
use model\class\DbConnector;

require_once dirname(__FILE__). "/../src/model/DbConnector.php";
require_once dirname(__FILE__).'/../src/model/fields.php';

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "../..");
$dotenv->load();

class TestFields extends TestCase
{
    /**
     * Test getting fields nominal case
     * @return void
     */
    public function testFieldsGetNominalCase() {
        //Given
        $exercise = 22;
        $expectedResult = array (
            0 =>
                (object) array(
                    'name' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi.',
                    'type' => 'Single line text',
                ),
            1 =>
                (object) array(
                    'name' => 'Nulla justo.',
                    'type' => 'Multi-line text',
                ),
            2 =>
                (object) array(
                    'name' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi.',
                    'type' => 'Single line text',
                ),
        );

        //When
        $actualResult = getFieldsByExercise($exercise);

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test Creation field nominal case
     * @return void
     */
    public function testFieldCreateNominalCase() {
        //Given
        $fieldName = "Une question ?";
        $fieldType = 1;
        $fieldExercise = 1;
        $expectedResult = 0;
        $actualResult = 0;

        //Connect to db
        $bd = new DbConnector(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_NAME'],
            $_ENV['DATABASE_USERNAME'],
            $_ENV['DATABASE_PASSWORD']
        );

        $resultQuery = $bd->Query(
            "SELECT f.name AS name, ft.name AS type FROM fields f JOIN fieldTypes ft ON f.fieldTypes_id = ft.id WHERE f.exercises_id = " . $fieldExercise . ";"
        );

        //check if result is empty
        if (!$resultQuery) {
            $expectedResult = 0;
        }

        //Get number of field existing
        foreach ($resultQuery as $exercise) {
            if($exercise->name == $fieldName) $expectedResult ++;
        }
        //+1 cause we will inser a new value
        $expectedResult += 1;

        //When
        createField($fieldName,$fieldType,$fieldExercise);

        $resultQuery = $bd->Query(
            "SELECT f.name AS name, ft.name AS type FROM fields f JOIN fieldTypes ft ON f.fieldTypes_id = ft.id WHERE f.exercises_id = " . $fieldExercise . ";"
        );

        //check if result is empty
        if (!$resultQuery) {
            $actualResult = 0;
        }

        //Get number of field existing
        foreach ($resultQuery as $exercise) {
            if($exercise->name == $fieldName) $actualResult ++;
        }

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test Creation field nominal case
     * @return void
     */
    public function testFieldsGetDontExist() {
        //Given
        $exercise = 100000;
        $expectedResult = [];

        //When
        $actualResult = getFieldsByExercise($exercise);

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }

}
