<?php

namespace App\controller;

use App\Model\Service\Exercises;
use App\Model\Service\Fields;

use function PHPUnit\Framework\throwException;

class ExercisesStatusController extends Controller
{
    protected array $variables;

    public function __construct($variables = array())
    {
        parent::__construct($variables);
    }

    public function update()
    {
        $exerciseId = $this->variables['exerciseId'];
        $status = $_REQUEST['status'];

        $fieldsCount = count(Fields::getFieldsByExercise($exerciseId));

        if ($status == 'Closed' || $status == 'Answering' && $fieldsCount > 0) {
            $newStatus = $status;
        } elseif ($fieldsCount == 0) {
            header("Location: /exercises/" . $exerciseId . "/fields");
        } else {
            throwException('You cannot update this exercise status.');
        }



        Exercises::updateExerciseStatus($exerciseId, $newStatus);
        header("Location: /manage");
    }
}
