<?php

namespace App\Controller;

use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use Exception;

class ExercisesStatusController extends Controller
{
    protected array $variables;

    /**
     *
     * @param $variables
     */
    public function __construct($variables = [])
    {
        parent::__construct($variables);
    }

    /**
     * Update an exercise status
     * @throws Exception
     */
    public function update(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $exerciseId = $this->variables['exerciseId'];
        $status = $_REQUEST['status'];

        $fieldsCount = count(Fields::getFieldsByExercise($exerciseId));

        if ($status == 'Closed' || $status == 'Answering' && $fieldsCount > 0) {
            $newStatus = $status;
        } elseif ($fieldsCount == 0) {
            header("Location: /exercises/" . $exerciseId . "/fields");
        } else {
            throw new Exception('You cannot update this exercise status', 403);
        }

        Exercises::updateExerciseStatus($exerciseId, $newStatus);
        header("Location: /manage");
    }
}
