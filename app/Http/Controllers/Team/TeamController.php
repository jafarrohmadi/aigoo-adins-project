<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        return view('team.index');
    }
}
