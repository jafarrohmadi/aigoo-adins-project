<?php

namespace App\Http\Resources\PlayerData;

use App\VwLeadeboard;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PlayerDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $vwLeadeboardDepartment = VwLeadeboard::where('department', $this->department)->get();
        $rankDepartment = $vwLeadeboardDepartment->filter(function ($value) {
            return $value->user_id === $this->id;
        })->keys()->first();

        $vwLeadeboardAll = VwLeadeboard::all();
        $rankAll = $vwLeadeboardAll->filter(function ($value) {
            return $value->user_id === $this->id;
        })->keys()->first();

        $dailyAttempt = DB::table('daily_attemps')->whereDate('created_at', Carbon::today())->get();
        $dailyAttempt1 = $dailyAttempt->where('game_id', 1)->where('user_id', $this->id)->pluck('attempt')->first();
        $dailyAttempt2 = $dailyAttempt->where('game_id', 2)->where('user_id', $this->id)->pluck('attempt')->first();
        $dailyAttempt3 = $dailyAttempt->where('game_id', 3)->where('user_id', $this->id)->pluck('attempt')->first();
        $dailyAttempt4 = $dailyAttempt->where('game_id', 4)->where('user_id', $this->id)->pluck('attempt')->first();

        return [
            'status'  => true,
            'message' => 'Success',
            'data' => [
                'player_id' => $this->id,
                'player_name' => $this->name,
                'gender' => $this->gender,
                'level' => $this->level,
                'department' => $this->department,
                'rank_department' => $rankDepartment + 1,
                'rank_all' => $rankAll + 1,
                'total_score' => $this->pointHistories->sum('score'),
                'total_poin' => $this->pointHistories->where('point', '>=', 0)->sum('point'),
                'current_poin' => $this->pointHistories->sum('point'),
                'daily_attempt_game1' => $dailyAttempt1 === null ? 0 : $dailyAttempt1,
                'daily_attempt_game2' => $dailyAttempt2 === null ? 0 : $dailyAttempt2,
                'daily_attempt_game3' => $dailyAttempt3 === null ? 0 : $dailyAttempt3,
                'daily_attempt_game4' => $dailyAttempt4 === null ? 0 : $dailyAttempt4,
                'profile_picture' => $this->profile_picture
            ]
        ];
    }
}
