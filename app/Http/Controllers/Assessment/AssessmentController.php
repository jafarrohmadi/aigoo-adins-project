<?php

namespace App\Http\Controllers\Assessment;

use App\Exports\AssessmentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AssessmentController extends Controller
{
    public function index()
    {
        return view('assessment.index');
    }

    public function bulkImport()
    {
        return view('assessment.bulk-import');
    }

}
