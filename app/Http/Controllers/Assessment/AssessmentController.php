<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Controllers\Controller;

class AssessmentController extends Controller
{
    public function index()
    {
        return view('assessment.index');
    }
}
