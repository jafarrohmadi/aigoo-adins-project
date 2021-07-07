<?php

namespace App\Http\Resources\Profile;

use App\ViewModels\VwLeadeboard;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $vwLeadeboardDepartment = VwLeadeboard::where('department', $this->department)->get();
        $rankDepartment         = $vwLeadeboardDepartment->filter(function ($value) {
            return $value->user_id === $this->id;
        })->keys()->first();

        $vwLeadeboardAll = VwLeadeboard::all();
        $rankAll         = $vwLeadeboardAll->filter(function ($value) {
            return $value->user_id === $this->id;
        })->keys()->first();

        $dailyAttemp  = DB::table('daily_attemps')->whereDate('created_at', Carbon::today())->get();
        $dailyAttemp1 = $dailyAttemp->where('game_id', 1)->where('user_id', $this->id)->pluck('attempt')->first();
        $dailyAttemp2 = $dailyAttemp->where('game_id', 2)->where('user_id', $this->id)->pluck('attempt')->first();
        $dailyAttemp3 = $dailyAttemp->where('game_id', 3)->where('user_id', $this->id)->pluck('attempt')->first();
        $dailyAttemp4 = $dailyAttemp->where('game_id', 4)->where('user_id', $this->id)->pluck('attempt')->first();

        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => [
                'player_data'       => [
                    'player_id'           => $this->id,
                    'player_name'         => $this->name,
                    'gender'              => $this->gender,
                    'level'               => $this->level,
                    'department'          => $this->department,
                    'rank_department'     => $rankDepartment + 1,
                    'rank_all'            => $rankAll + 1,
                    'total_score'         => $this->pointHistories->sum('score'),
                    'total_poin'          => $this->pointHistories->where('point', '>=', 0)->sum('point'),
                    'current_poin'        => $this->pointHistories->sum('point'),
                    'daily_attempt_game1' => $dailyAttemp1 === null ? 0 : $dailyAttemp1,
                    'daily_attempt_game2' => $dailyAttemp2 === null ? 0 : $dailyAttemp2,
                    'daily_attempt_game3' => $dailyAttemp3 === null ? 0 : $dailyAttemp3,
                    'daily_attempt_game4' => $dailyAttemp4 === null ? 0 : $dailyAttemp4,
                    'profile_picture'     => $this->profile_picture
                ],
                'game1_player_data' => [
                    'daily_attempt' => $dailyAttemp1 === null ? 0 : $dailyAttemp1,
                    'total_score'   => $this->pointHistories->where('game_id', 1)->sum('score'),
                ],
                'game2_player_data' => [
                    'daily_attempt'            => $dailyAttemp2 === null ? 0 : $dailyAttemp2,
                    'accepted_challenge_count' => $this->challenges2->where('user_id2', $this->id)->whereIn('status',
                        ['Accept', 'Finish'])->whereBetween('date', [Carbon::parse('-24 hours'), now()])->count(),
                    'total_score'              => $this->pointHistories->where('game_id', 2)->sum('score'),
                    'challenge_in'             => Challenges2Resource::collection($this->challenges2->where('status',
                        'Pending')),
                    'challenge_out'            => Challenges1Resource::collection($this->challenges1->whereNotIn('status',
                        ['Expire'])),
                ],
                'game3_player_data' => [
                    'daily_attempt' => $dailyAttemp3 === null ? 0 : $dailyAttemp3,
                    'total_score'   => $this->pointHistories->where('game_id', 3)->sum('score'),
                    "stages"        => [

                    ]
                ]
            ]
        ];
    }
}
