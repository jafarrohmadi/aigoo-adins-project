<?php

namespace App\Http\Controllers\LeaderBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaderBoardController extends Controller
{
    public function index()
    {
        return view('leaderboards.index');
    }
}
