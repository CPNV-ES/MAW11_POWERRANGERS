<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use App\Model\Service\Fulfillments;

class FullfilmentsController extends Controller
{
    public function create()
    {
        $fulfillment = Fulfillments::createFulfillment();
        $exerciseId = $this->variables['exerciseId'];

        foreach ($_POST as $field => $value) {
            Answers::createAnswer($value, $fulfillment, $field);
        }

        header("Location: /exercises/" . $exerciseId . "/answer/" . $fulfillment . "/edit");
    }

    public function show()
    {
        $fulfillmentId = $this->variables['fulfillmentsId'];
        $fulfillment = Fulfillments::getFulfillmentById($fulfillmentId);
        $exerciseId = $this->variables['exerciseId'];
        $exercise = Exercises::getExerciseById($exerciseId);
        $fields = Fields::getFieldsByExercise($exerciseId);
        $answers = Answers::getAnswersByFulfillment($fulfillmentId);
        require_once SOURCE_DIR . "/view/pages/fulfillments.php";
    }

}