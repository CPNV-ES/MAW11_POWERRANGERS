<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\FieldTypes;
use App\Model\Service\Fulfillments;
use Exception;


class FieldController extends Controller
{
    public function index(): void
    {
        if (!is_numeric($this->variables['fieldId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);
        $fields = Fields::getFieldsById($this->variables['fieldId']);
        $answers = Answers::getAnswersByField($this->variables['fieldId']);

        if (empty($fields)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        foreach ($answers as $answer) {
            $fulfillments[] = Fulfillments::getFulfillmentById($answer->fulfillments_id)[0];
        }
        foreach ($fulfillments as $fulfillment) {
            $result[$fulfillment->id] = $fulfillment;
        }
        $fulfillments = $result;
        require_once SOURCE_DIR . "/view/pages/fieldsResult.php";
    }

}
