<?php

namespace App\Controller;

use App\Model\Service\Answers;
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

}