<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../src/model/fields.php';

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "../..");
$dotenv->load();


class TestFields extends TestCase
{
    public function testFieldsGetNominalCase() {
        //Given
        $exercise = 1;
        $expectedResult = "Tax Accountant";

        //When
        $actualResult = getAllFieldsByExercise($exercise);

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testFieldCreateNominalCase() {
        //Given
        $fieldName = "Une question ?";
        $fieldType = 1;
        $fieldExercise = 1;
        $expectedResult = "Vending Avril";

        //When
        $actualResult = createField($fieldName,$fieldType,$fieldExercise);

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }


    public function testFieldsGetDontExist() {
        //Given
        $exercise = 1;
        $expectedResult = "Vending Avril";

        //When
        $actualResult = getAllFieldsByExercise($exercise);

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }

}
