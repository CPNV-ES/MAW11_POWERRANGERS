<?php

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require_once BASE_DIR . '/vendor/autoload.php';

use App\Controller\FieldsController;
use App\HandlerResponse;
use App\Renderer;
use PHPUnit\Framework\TestCase;
use App\Model\Service\Fields;

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(SOURCE_DIR . "/..");
$dotenv->load();

class TestFields extends TestCase
{
    /**
     * Test getting fields nominal case
     * @return void
     */
    public function testFieldsGetNominalCase()
    {
        //Given
        $exercise = 22;

        //When
        $actualResult = Fields::getFieldsByExercise($exercise);

        //Then
        $this->assertIsArray($actualResult);
    }

    /**
     * Test Creation field nominal case
     * @return void
     */
    public function testFieldCreateNominalCase()
    {
        //Given
        $fieldName = "Une question ?";
        $fieldType = 1;
        $fieldExercise = 1;

        //When
        $_POST["name"] = $fieldName;
        $_POST["fieldType"] = $fieldType;

        new Renderer(
            new HandlerResponse([FieldsController::class, "store"], 200),
            ["exerciseId" => $fieldExercise]
        );

        //Then
        $this->assertEquals(302, http_response_code());
    }

    /**
     * Test Creation field if lenght of fieldname is too long
     * @return void
     */
    public function testFieldCreateHandleFieldNameTooLong()
    {
        //Given
        $fieldName = "
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida elit sed enim interdum, 
        nec aliquam diam iaculis. Cras id pretium dolor. Praesent nulla enim, facilisis vitae tortor blandit, 
        tempus posuere dolor. Praesent nec tincidunt felis. Etiam facilisis finibus arcu, id varius urna fringilla ac.
        Quisque mollis est quis dui tincidunt, ac congue sem ullamcorper. Vivamus ut nisi vitae arcu semper semper ut 
        ut augue.
        Quisque nisl est, accumsan ac imperdiet sodales, ultricies sit amet ligula porttitor. Plus
        ";
        $fieldType = 1;
        $fieldExercise = 1;

        //When
        $_POST["name"] = $fieldName;
        $_POST["fieldType"] = $fieldType;

        new Renderer(
            new HandlerResponse([FieldsController::class, "store"], 200),
            ["exerciseId" => $fieldExercise]
        );

        //Then
        $this->assertEquals(406, http_response_code());
    }

    /**
     * Test Creation field if fieldtype is empty
     * @return void
     */
    public function testFieldCreateHandleEmptyValue()
    {
        //Given
        $fieldName = "";
        $fieldType = null;
        $fieldExercise = 1;

        //When
        $_POST["name"] = $fieldName;
        $_POST["fieldType"] = $fieldType;

        new Renderer(
            new HandlerResponse([FieldsController::class, "store"], 200),
            ["exerciseId" => $fieldExercise]
        );

        //Then
        $this->assertEquals(406, http_response_code());
    }

    /**
     * Test deletion of a field
     * @return void
     */
    public function testFieldDeleteNominalCase()
    {
        //Given
        $fieldName = "Une question ?";
        $fieldType = 1;
        $fieldExercise = 1;

        //When
        $fieldId = Fields::createField("test", 1, 1);

        //When
        $_POST["fieldId"] = $fieldId;

        new Renderer(
            new HandlerResponse([FieldsController::class, "destroy"], 200),
            ["exerciseId" => $fieldExercise]
        );

        //Then
        $this->assertEquals(302, http_response_code());
    }

    /**
     * Test Creation field nominal case
     * @return void
     */
    public function testFieldsGetDontExist()
    {
        //Given
        $exercise = 100000;
        $expectedResult = [];

        //When
        $actualResult = Fields::getFieldsByExercise($exercise);

        //Then
        $this->assertEquals($expectedResult, $actualResult);
    }
}
