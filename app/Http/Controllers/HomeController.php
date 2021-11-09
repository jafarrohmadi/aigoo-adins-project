<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\PointHistory;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count       = User::count();
        $department_count = Department::count();

        $point_histories = PointHistory::whereBetween('created_at', [
            Carbon::now()->setTime(0, 0, 0),
            Carbon::now()->setTime(23, 59, 59)
        ])
            ->get();

        $played_today      = count($point_histories->groupBy('user_id'));
        $total_coins_today = collect($point_histories)->sum('points');

        return view('home', compact('user_count', 'department_count', 'played_today', 'total_coins_today'));
    }
}
