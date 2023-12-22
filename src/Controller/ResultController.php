<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\Fulfillments;
use Exception;

class ResultController extends Controller
{
    /**
     * Show the result page with filtered variables
     * @return void
     * @throws Exception
     */
    public function index(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $fulfillments = Fulfillments::getFulfillmentsByExerciseId($this->variables['exerciseId']);
        $fields = Fields::getFieldsByExercise($this->variables['exerciseId']);
        $answers = array_map(function ($fulfillment) {
            return Answers::getAnswersByFulfillment($fulfillment->fulfillment_id);
        }, $fulfillments);
        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);

        if (empty($exercise)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        //sort the array fields to desc order of id
        usort($fields, function ($a, $b) {
            return $a->fid <=> $b->field_id;
        });

        //sort the array answers to desc order of id
        array_map(function ($answer) {
            return usort($answer, function ($a, $b) {
                return $a->id <=> $b->id;
            });
        }, $answers);

        require_once SOURCE_DIR . "/view/pages/results.php";
    }
}
