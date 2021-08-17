<?php

namespace App\Http\Controllers\Api\v1\Department;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Department\DepartmentCollection;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{
    public function index(Request $request)
    {
        $data = Department::get();

        return new DepartmentCollection($data);
    }
}