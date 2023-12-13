<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\FieldTypes;
use App\Model\Service\Fulfillments;


class FieldController extends Controller
{
    public function index(): void
    {
        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);
        $fields = Fields::getFieldsById($this->variables['fieldId']);
        $answers = Answers::getAnswersByField($this->variables['fieldId']);
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
