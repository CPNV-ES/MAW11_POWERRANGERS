<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fulfillments;
use Exception;

class FullfilmentsController extends Controller
{
    public function create() : void
    {
        $fulfillment = Fulfillments::createFulfillment();
        $exerciseId = $this->variables['exerciseId'];

        foreach ($_POST as $field => $value) {
            Answers::createAnswer($value, $fulfillment, $field);
        }

        header("Location: /exercises/" . $exerciseId . "/answer/" . $fulfillment . "/edit");
    }

    /**
     * @throws Exception
     */
    public function show() : void
    {
        $fulfillmentId = $this->variables['fulfillmentsId'];
        $fulfillment = Fulfillments::getFulfillmentById($fulfillmentId);
        $exerciseId = $this->variables['exerciseId'];
        $exercise = Exercises::getExerciseById($exerciseId);
        $answers = Answers::getAnswersByFulfillment($fulfillmentId);
        require_once SOURCE_DIR . "/view/pages/fulfillments.php";
    }

}
