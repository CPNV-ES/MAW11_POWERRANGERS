<?php

namespace App\Controller;

use App\Model\Service\Exercises;
use App\Model\Service\Fields;

class ManageController extends Controller
{
    protected array $variables;

    public function __construct($variables = array())
    {
        parent::__construct($variables);
    }

    public function index()
    {
        $exercises = $this->addFieldCountOnExercises(Exercises::getAllExercises());

        $exercises_building = $this->filterExercises($exercises, 'Building');
        $exercises_answering = $this->filterExercises($exercises, 'Answering');
        $exercises_closed = $this->filterExercises($exercises, 'Closed');

        require_once SOURCE_DIR . "/view/pages/manage.php";
    }

    private function filterExercises($exercises, $status)
    {
        $exercises_filtered = [];
        foreach ($exercises as $exercise) {
            if ($exercise['status'] == $status) {
                array_push($exercises_filtered, $exercise);
            }
        }
        return $exercises_filtered;
    }

    private function addFieldCountOnExercises($exercises)
    {
        $result = [];
        foreach ($exercises as $exercise) {
            $fields = Fields::getFieldsByExercise($exercise['id']);
            $exercise['fieldCount'] = count($fields);
            array_push($result, $exercise);
        }
        return $result;
    }
}
