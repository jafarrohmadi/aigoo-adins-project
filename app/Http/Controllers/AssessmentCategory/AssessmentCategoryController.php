<?php

namespace App\Http\Controllers\AssessmentCategory;

use App\Http\Controllers\Controller;

class AssessmentCategoryController extends Controller
{
    public function index()
    {
        return view('assessment-category.index');
    }
}
