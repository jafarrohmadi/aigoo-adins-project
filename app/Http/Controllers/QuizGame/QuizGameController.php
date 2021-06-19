<?php

namespace App\Http\Controllers\QuizGame;

use App\Http\Controllers\Controller;

class QuizGameController extends Controller
{
    public function choices()
    {
        return view('quiz-game.choices');
    }

    public function matches()
    {
        return view('quiz-game.matches');
    }

    public function completes()
    {
        return view('quiz-game.completes');
    }
}
