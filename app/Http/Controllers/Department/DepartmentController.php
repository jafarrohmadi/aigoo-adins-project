<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department.index');
    }
}
