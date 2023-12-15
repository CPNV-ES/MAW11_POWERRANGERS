<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\Fulfillments;
use Exception;
use function PHPUnit\Framework\isEmpty;

class ResultController extends Controller
{
    public function index() :void
    {
        if (!is_int($this->variables['exerciseId'])){
            throw new Exception("exerciseID should be an integer");
        }

        $fulfillments = Fulfillments::getFulfillmentsByExerciseId($this->variables['exerciseId']);
        $fields = Fields::getFieldsByExercise($this->variables['exerciseId']);
        $answers = array_map(function ($fulfillment) {
            return Answers::getAnswersByFulfillment($fulfillment->fulfillment_id);
        }, $fulfillments);
        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);

        if (isEmpty($exercise)) {
            throw new Exception("Cannot found this exercise");
        }

        $formattedAnswers = [];

        foreach ($fulfillments as $fulfillment) {
            foreach ($fields as $field) {
                foreach ($answers as $answer){
                    foreach ($answer as $item){
                        if ($item->fulfillment_id == $fulfillment->fulfillment_id && $item->fieldName == $field->name)
                            $formattedAnswers[$fulfillment->dateTime][$field->id] = $item->value;
                    }
                }
            }
        }

        require_once SOURCE_DIR . "/view/pages/results.php";
    }
}