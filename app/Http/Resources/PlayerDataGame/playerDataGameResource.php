<?php

namespace App\Http\Resources\PlayerDataGame;

use App\Challenge;
use App\Domains\Auth\Models\User;
use App\Http\Resources\Profile\Challenges1Resource;
use App\Http\Resources\Profile\Challenges2Resource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class playerDataGameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::where('id', Auth::id())->with(['challenges1', 'challenges2'])->first();

        $dailyAttempt = DB::table('daily_attemps')->whereDate('created_at', Carbon::today())->get();

        if ($this->resource == 1) {
            $dailyAttempt1 = $dailyAttempt->where('game_id', 1)->where('user_id', $user->id)->pluck('attempt')->first();

            return [
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'game1_player_data' => [
                        'daily_attempt' => $dailyAttempt1 === null ? 0 : $dailyAttempt1,
                        'total_score' => $user->pointHistories->where('game_id', 1)->sum('score'),
                    ]
                ]
            ];
        } elseif ($this->resource == 2) {
            $dailyAttempt2 = $dailyAttempt->where('game_id', 2)->where('user_id', $user->id)->pluck('attempt')->first();

            return [
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'game2_player_data' => [
                        'daily_attempt' => $dailyAttempt2 === null ? 0 : $dailyAttempt2,
                        'accepted_challenge_count' => Challenge::where('user_id2', $user->id)->whereIn('status', ['Accept', 'Finish'])->whereBetween('date', [Carbon::parse('-24 hours'), now()])->count(),
                        'total_score' => $user->pointHistories->where('game_id', 2)->sum('score'),
                        'challenge_in' => Challenges2Resource::collection($user->challenges2),
                        'challenge_out' => Challenges1Resource::collection($user->challenges1),
                    ]
                ]
            ];
        } elseif ($this->resource == 3) {
            $dailyAttempt3 = $dailyAttempt->where('game_id', 3)->where('user_id', $user->id)->pluck('attempt')->first();

            return [
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'game3_player_data' => [
                        'daily_attempt' => $dailyAttempt3 === null ? 0 : $dailyAttempt3,
                        'total_score' => $user->pointHistories->where('game_id', 3)->sum('score'),
                        'stages' => [

                        ]
                    ]
                ]
            ];
        } else {
            $dailyAttempt4 = $dailyAttempt->where('game_id', 4)->where('user_id', $user->id)->pluck('attempt')->first();

            return [
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'game4_player_data' => [
                        'daily_attempt' => $dailyAttempt4 == null ? 0 : $dailyAttempt4,
                        'total_score' => $user->pointHistories->where('game_id', 4)->sum('score'),
                        'stages' => [

                        ]
                    ]
                ]
            ];
        }
    }
}
