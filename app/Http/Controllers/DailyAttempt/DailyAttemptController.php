<?php

namespace App\Http\Controllers\DailyAttempt;

use App\Http\Controllers\Controller;

class DailyAttemptController extends Controller
{
    public function index()
    {
        return view('daily-attempt.index');
    }
}
