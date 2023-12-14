<?php

namespace App\Model\Service;

class Results
{
    public static function result($exerciseId)
    {
        $response = [];

        $fulfillments = Fulfillments::getFulfillmentsByExerciseId($exerciseId);
        $fields = Fields::getFieldsByExercise($exerciseId);
        $answers = array_map(function ($fulfillment) {
            return Answers::getAnswersByFulfillment($fulfillment->fulfillment_id);
        }, $fulfillments);
        $exercise = Exercises::getExerciseById($exerciseId);

        $result = [];
        foreach ($fields as $field) {
            foreach ($fulfillments as $fulfillment) {
                if ($answers->fulfillment_id ==  $fulfillment->fulfillment_id && $answers->fieldName == $field->id)
                    $result[$field->id][$fulfillment->id] = $answers->value;

            }
        }

        return $result;

    }
}