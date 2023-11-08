<?php

use model\class\HandlerResponse;
use model\class\Renderer;
use PHPUnit\Framework\TestCase;
use model\class\DbConnector;

require_once dirname(__FILE__). "/../src/model/DbConnector.php";
require_once dirname(__FILE__).'/../src/model/fields.php';
require_once dirname(__FILE__).'/../src/Renderer.php';
require_once dirname(__FILE__).'/../src/HandlerResponse.php';


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

        //When
        $_POST["name"] = $fieldName;
        $_POST["fieldType"] = $fieldType;

        new Renderer(New HandlerResponse("controller/fieldsInsert.php", 200),["exerciseId" => $fieldExercise]);

        //Then
        $this->assertEquals(302, http_response_code() );
    }

    /**
     * Test Creation field if lenght of fieldname is too long
     * @return void
     */
    public function testFieldCreateHandleFieldNameTooLong() {
        //Given
        $fieldName = "
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida elit sed enim interdum, 
        nec aliquam diam iaculis. Cras id pretium dolor. Praesent nulla enim, facilisis vitae tortor blandit, 
        tempus posuere dolor. Praesent nec tincidunt felis. Etiam facilisis finibus arcu, id varius urna fringilla ac.
        Quisque mollis est quis dui tincidunt, ac congue sem ullamcorper. Vivamus ut nisi vitae arcu semper semper ut ut augue.
        Quisque nisl est, accumsan ac imperdiet sodales, ultricies sit amet ligula porttitor. Plus
        ";
        $fieldType = 1;
        $fieldExercise = 1;

        //When
        $_POST["name"] = $fieldName;
        $_POST["fieldType"] = $fieldType;

        new Renderer(New HandlerResponse("controller/fieldsInsert.php", 200),["exerciseId" => $fieldExercise]);

        //Then
        $this->assertEquals(406, http_response_code() );

    }

    /**
     * Test Creation field if fieldtype is empty
     * @return void
     */
    public function testFieldCreateHandleEmptyValue() {
        //Given
        $fieldName = "";
        $fieldType = Null;
        $fieldExercise = 1;

        //When
        $_POST["name"] = $fieldName;
        $_POST["fieldType"] = $fieldType;

        new Renderer(New HandlerResponse("controller/fieldsInsert.php", 200),["exerciseId" => $fieldExercise]);

        //Then
        $this->assertEquals(406, http_response_code() );

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
