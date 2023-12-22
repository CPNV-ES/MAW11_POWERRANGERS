<?php

namespace App\Controller;

use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use Exception;

class ManageController extends Controller
{
    protected array $variables;

    public function __construct($variables = array())
    {
        parent::__construct($variables);
    }

    /**
     * Show the manage page with all necessary variables
     * @return void
     * @throws Exception
     */
    public function index(): void
    {
        $exercises = $this->addFieldCountOnExercises(Exercises::getAllExercises());

        $exercises_building = $this->filterExercises($exercises, 'Building');
        $exercises_answering = $this->filterExercises($exercises, 'Answering');
        $exercises_closed = $this->filterExercises($exercises, 'Closed');

        require_once SOURCE_DIR . "/view/pages/manage.php";
    }

    /**
     * Filtering Exercise by status
     * @param array $exercises
     * @param string $status
     * @return array
     */
    private function filterExercises(array $exercises, string $status): array
    {
        $exercises_filtered = [];
        foreach ($exercises as $exercise) {
            if ($exercise['status'] == $status) {
                array_push($exercises_filtered, $exercise);
            }
        }
        return $exercises_filtered;
    }

    /**
     * Adding field count on exercise
     * @param $exercises
     * @return array
     * @throws Exception
     */
    private function addFieldCountOnExercises($exercises): array
    {
        $result = [];
        foreach ($exercises as $exercise) {
            $fields = Fields::getFieldsByExercise($exercise['id']);
            $exercise['fieldsCount'] = count($fields);
            array_push($result, $exercise);
        }
        return $result;
    }
}
