<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index()
    {
        return view('question.index');
    }
}
