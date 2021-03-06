<?php

namespace App\Http\Controllers\Api\v1\DailyAttempt;

use App\Http\Controllers\Api\BaseController;
use App\Models\DailyAttempt;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyAttemptController extends
    BaseController
{
    public function store(Request $request)
    {
        $userDailyAttemps = DailyAttempt::where('user_id', me()->id)
            ->where('quiz_ID', $request->input('quiz_ID'))
            ->whereDate('date', Carbon::today())
            ->first();
        $maxDailyAttemps  = Setting::where('group_name', 'game_settings')->get();
        if ($userDailyAttemps) {

            if (($request->quiz_ID == 1 && $maxDailyAttemps[0]->value == $userDailyAttemps->attempt) ||
                ($request->quiz_ID == 2 && $maxDailyAttemps[1]->value == $userDailyAttemps->attempt) ||
                ($request->quiz_ID == 3 && $maxDailyAttemps[2]->value == $userDailyAttemps->attempt)) {
                return $this->returnFalse();
            }

            $userDailyAttemps->update(['attempt' => $userDailyAttemps['attempt'] + 1]);
            $userDailyAttempsInsert = DailyAttempt::where('user_id', me()->id)
                ->where('quiz_ID', $request->input('quiz_ID'))
                ->whereDate('date', Carbon::today())
                ->first();
        } else {
            $userDailyAttempsInsert = DailyAttempt::create([
                'user_id' => me()->id,
                'quiz_ID' => $request->input('quiz_ID') ?? 1,
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