<?php

namespace App\Http\Controllers\LeaderBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaderBoardController extends Controller
{
    public function leaderboard()
    {
        return view('leaderboards.index');
    }
}
