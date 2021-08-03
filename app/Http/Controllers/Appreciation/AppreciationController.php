<?php

namespace App\Http\Controllers\Appreciation;

use App\Http\Controllers\Controller;

class AppreciationController extends Controller
{
    public function index()
    {
        return view('appreciation.index');
    }
}
