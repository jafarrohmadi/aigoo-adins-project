<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Department;
use App\Models\PointHistory;
use App\Models\User;
use App\ViewModels\VwLeadeboard;
use App\ViewModels\VwLeaderboardGuild;
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
        $user_have_assessment = count(Assessment::where('assessment_year_month' , date('Y-m'))->groupBy('assessor_id')->get());
        $user_dont_have_assessment = $user_count - $user_have_assessment;
        $point_histories = PointHistory::whereBetween('created_at', [
            Carbon::now()->setTime(0, 0, 0),
            Carbon::now()->setTime(23, 59, 59)
        ])
            ->get();

        $played_today      = count($point_histories->groupBy('user_id'));
        $total_coins_today = collect($point_histories)->sum('points');
        $nasionalData = VwLeadeboard::where('date', date('Y-m'))->orderBy('total_points', 'desc')->first();
        $nasionalEmployee = $nasionalData ? $nasionalData->name : 'No Data';

        $departmentWin = VwLeaderboardGuild::with('department')
            ->where('date', date('Y-m'))
            ->orderBy('total_points', 'desc')
            ->first();
        $departmentWinner = $departmentWin ? $departmentWin->department->name: 'No Data';

        return view('home', compact('user_count', 'played_today', 'total_coins_today', 'user_have_assessment', 'user_dont_have_assessment', 'nasionalEmployee', 'departmentWinner'));
    }
}
