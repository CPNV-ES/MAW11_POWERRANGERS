<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\Fulfillments;

class ResultController extends Controller
{
    public function index() :void
    {
        $fulfillments = Fulfillments::getFulfillmentsByExerciseId($this->variables['exerciseId']);
        $fields = Fields::getFieldsByExercise($this->variables['exerciseId']);
        $answers = array_map(function ($fulfillment) {
            return Answers::getAnswersByFulfillment($fulfillment->fulfillment_id);
        }, $fulfillments);
        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);

        $result = [];
        foreach ($fields as $field) {
            foreach ($fulfillments as $fulfillment) {
                if ($answers->fulfillment_id ==  $fulfillment->id)
                    $result[$field->id][$fulfillment->id] = $answers->value;

            }
        }

        require_once SOURCE_DIR . "/view/pages/results.php";
    }
}