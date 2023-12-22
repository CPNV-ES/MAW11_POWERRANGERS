<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fulfillments;
use Exception;

use function PHPUnit\Framework\isEmpty;

class FullfilmentsController extends Controller
{
    public function create(): void
    {
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

        header("Location: /exercises/" . $exerciseId . "/answer/" . $fulfillment . "/edit");
    }

    /**
     * @throws Exception
     */
    public function show(): void
    {
        $fulfillmentId = $this->variables['fulfillmentsId'];
        $fulfillment = Fulfillments::getFulfillmentById($fulfillmentId);
        $exerciseId = $this->variables['exerciseId'];
        $exercise = Exercises::getExerciseById($exerciseId);
        $answers = Answers::getAnswersByFulfillment($fulfillmentId);
        require_once SOURCE_DIR . "/view/pages/fulfillments.php";
    }
}
