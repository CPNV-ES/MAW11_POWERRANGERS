<?php

namespace App\Controller;

use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\FieldTypes;
use Exception;

class FieldsController extends Controller
{
    /**
     * Show the filed page by getting all fields information
     * @return void
     * @throws Exception
     */
    public function index()
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $fields = Fields::getFieldsByExercise($this->variables['exerciseId']);
        $fieldsTypes = FieldTypes::getFieldsTypes();
        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);

        if (empty($exercise)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        require_once SOURCE_DIR . "/view/pages/fields.php";
    }

    /**
     * Creating a new field
     * @return void
     * @throws Exception
     */
    public function store(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $fieldName = $_POST["name"];
        $fieldType = $_POST["fieldType"];
        $fieldExercise = $this->variables['exerciseId'];

        if (strlen($fieldName) > 512) {
            $error_name = "The label of your field can't exceed 512 characters";
            http_response_code(406);
            $this->index();
        } elseif ($fieldType == null) {
            $error_select = "The value kind cannot be empty";
            http_response_code(406);
            $this->index();
        } else {
            Fields::createField($fieldName, $fieldType, $fieldExercise);
            header("Location: /exercises/" . $this->variables['exerciseId'] . "/fields");
        }
    }

    /**
     * Destroy a field
     * @return void
     * @throws Exception
     */
    public function destroy(): void
    {
        Fields::deleteField(intval($this->variables['fieldId']));
        header("Location: /exercises/" . $this->variables['exerciseId'] . "/fields");
    }

    /**
     * Edit a field
     * @return void
     * @throws Exception
     */
    public function edit(): void
    {
        if (!is_numeric($this->variables['exerciseId']) || !is_numeric($this->variables['fieldId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $field = Fields::getFieldsById($this->variables['fieldId']);
        $fieldsTypes = FieldTypes::getFieldsTypes();
        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);

        if (empty($field)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        require_once SOURCE_DIR . "/view/pages/fieldsUpdate.php";
    }

    /**
     * Update a field
     * @return void
     * @throws Exception
     */
    public function update(): void
    {
        if (!is_numeric($this->variables['exerciseId']) || !is_numeric($this->variables['fieldId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $fieldName = $_POST["name"];
        $fieldType = $_POST["fieldType"];
        $fieldExercise = $this->variables['exerciseId'];
        $fieldId = $this->variables['fieldId'];

        if (strlen($fieldName) > 512) {
            $error_name = "The label of your field can't exceed 512 characters";
            http_response_code(406);
            $this->index();
        } elseif ($fieldType == null) {
            $error_select = "The value kind cannot be empty";
            http_response_code(406);
            $this->index();
        } else {
            Fields::updateField($fieldName, $fieldType, $fieldId);
            header("Location: /exercises/" . $this->variables['exerciseId'] . "/fields");
        }
    }
}
