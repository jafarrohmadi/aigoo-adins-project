<?php

namespace App\Http\Controllers\Api\v1\Quiz;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\QuestionGame\QuestionGameCollection;

class QuizGameController extends BaseController
{
    public function index($category)
    {
        if ($category) {
            return new QuestionGameCollection(['category' => $category]);
        } else {
            return $this->returnFalse();
        }
    }
}