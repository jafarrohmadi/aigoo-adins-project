<?php

namespace App\Http\Resources\Profile;

use App\Models\DailyAttempt;
use App\Models\Department;
use App\ViewModels\VwLeadeboard;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProfileResource extends
    JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $vwLeadeboardDepartment = VwLeadeboard::where('department_id', $this->department_id)->get();
        $rankDepartment         = $vwLeadeboardDepartment->filter(function ($value) {
            return $value->user_id === $this->id;
        })->keys()->first();

        $vwLeadeboardAll = VwLeadeboard::all();
        $rankAll         = $vwLeadeboardAll->filter(function ($value) {
            return $value->user_id === $this->id;
        })->keys()->first();

        $dailyAttemp = DailyAttempt::whereDate('created_at', Carbon::today())->where('quiz_ID', 1)->where('user_id',
            $this->id)->pluck('attempt')->first();

        $departmentData = Department::where('id' , $this->department_id)->first();

        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => [
                'player_data'      => [
                    'player_id'          => $this->id,
                    'player_name'        => $this->name,
                    'gender'             => $this->gender,
                    'level'              => $this->level,
                    'department'         => $this->department,
                    'rank_department'    => $rankDepartment + 1,
                    'rank_all'           => $rankAll + 1,
                    'total_coins'        => $this->pointHistories->where('coins', '>=', 0)->sum('coins'),
                    'total_poin'         => $this->pointHistories->sum('point'),
                    'current_coin'       => $this->pointHistories->sum('coins'),
                    'daily_attempt_game' => $dailyAttemp === null ? 0 : $dailyAttemp,
                    'profile_picture'    => (asset('img/profile_picture').'/').$this->change_avatar ?? $this->avatar,
                    'team_leader'        => $departmentData->team_leader == $this->id ? 1 : 0,
                ],
                'game_player_data' => [
                    'daily_attempt' => $dailyAttemp === null ? 0 : $dailyAttemp,
                    'total_coins'   => $this->pointHistories->where('quiz_ID', 1)->sum('coins'),
                ],
                'user_collection'  => $this->userCollection->pluck('collection'),
                'team'             => [
                    'team_name' => $this->departments->team_name,
                    'team_icon' => (asset('img/profile_picture').'/').$this->departments->team_icon ?? 'default_team_avatar',
                ],
            ],
        ];
    }
}
