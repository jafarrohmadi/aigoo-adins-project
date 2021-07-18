<?php

namespace App\Http\Controllers\Api\v1\DailyAttempt;

use App\Http\Controllers\Api\BaseController;
use App\Models\DailyAttempt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyAttemptController extends BaseController
{
    public function store(Request $request)
    {
        $userDailyAttemps = DailyAttempt::where('user_id', me()->id)
            ->where('game_id', $request->input('game_id'))
            ->whereDate('date', Carbon::today())
            ->first();

        if ($userDailyAttemps) {
            $userDailyAttempsInsert = $userDailyAttemps->update(['attempt' => $userDailyAttemps['attempt'] + 1]);
        } else {
            $userDailyAttempsInsert = DailyAttempt::create([
                'user_id' => me()->id,
                'game_id' => $request->input('game_id') ?? 1,
                'date'    => now(),
                'attempt' => 1,
            ]);
        }

        if ($userDailyAttempsInsert) {
            return $this->returnSuccess($userDailyAttempsInsert);
        } else {
            return $this->returnFalse();
        }
    }
}