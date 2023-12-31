<?php

namespace App\Controller;

use App\Model\Service\Answers;
use App\Model\Service\Exercises;
use App\Model\Service\Fields;
use Exception;

class AnswersController extends Controller
{
    /**
     * Edit an answer
     * @return void
     * @throws Exception
     */
    public function edit(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);
        $fields = Answers::getAnswersByFulfillment($this->variables['answerId']);
        $description = "Bookmark this page, it's yours. You'll be able to come back later to finish.";

        if (empty($exercise)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        require_once SOURCE_DIR . "/view/pages/answer.php";
    }

    /**
     * Update an answer
     * @return void
     * @throws Exception
     */
    public function update(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $exerciseId = $this->variables['exerciseId'];
        $answerId = $this->variables['answerId'];

        foreach ($_POST as $field => $value) {
            if (strlen($value) <= 255) {
                Answers::updateAnswer($value, $field);
            }
        }

        // load view for answers
        header("Location: /exercises/" . $exerciseId . "/answer/" . $answerId . "/edit");
    }

    /**
     * Create a new answer
     * @return void
     * @throws Exception
     */
    public function create(): void
    {
        if (!is_numeric($this->variables['exerciseId'])) {
            throw new Exception("exerciseID should be an integer", 400);
        }

        $exercise = Exercises::getExerciseById($this->variables['exerciseId']);
        $fields = Fields::getFieldsByExercise($this->variables['exerciseId']);
        $description = "If you'd like to come back later to finish, simply submit it with blanks";

        if (empty($exercise)) {
            throw new Exception("Cannot found this exercise", 404);
        }

        require_once SOURCE_DIR . "/view/pages/answer.php";
    }
}
