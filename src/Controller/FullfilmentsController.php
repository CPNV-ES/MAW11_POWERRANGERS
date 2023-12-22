<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fulfillments;
use Exception;

class FullfilmentsController extends Controller
{
    /**
     * Create a fulfillment
     * @return void
     * @throws Exception
     */
    public function create(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $exerciseId = $this->variables['exerciseId'];

        foreach ($_POST as $field => $value) {
            if (strlen($value) > 255) {
                header("Location: /exercises/" . $exerciseId . "/answer");
                return;
            }
        }

        $fulfillment = Fulfillments::createFulfillment();

        foreach ($_POST as $field => $value) {
            Answers::createAnswer($value, $fulfillment, $field);
        }

        if (empty($fulfillment)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        header("Location: /exercises/" . $exerciseId . "/answer/" . $fulfillment . "/edit");
    }

    /**
     * Show a fulfillment
     * @throws Exception
     */
    public function show(): void
    {
        if (!is_numeric($this->variables['fulfillmentsId']) || !is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $fulfillmentId = $this->variables['fulfillmentsId'];
        $fulfillment = Fulfillments::getFulfillmentById($fulfillmentId);
        $exerciseId = $this->variables['exerciseId'];
        $exercise = Exercises::getExerciseById($exerciseId);
        $answers = Answers::getAnswersByFulfillment($fulfillmentId);

        if (empty($fulfillment) || empty($exercise)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        require_once SOURCE_DIR . "/view/pages/fulfillments.php";
    }
}
