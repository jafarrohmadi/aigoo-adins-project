<?php

namespace App\Http\Resources\Leaderboard;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaderBoardUserResource extends
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
        $data  = $this->user;
        $date = $request->date ?? date('Y-m');

        return [
            'name'        => $data->name,
            'department'  => $data->department,
            'level'       => $data->level,
            'points'      => $data->pointHistories->where('point', '>=', 0)->where('date_year_month', $date)->sum('point'),
            'profilePict' => (asset('img/profile_picture').'/').$data->change_avatar ?? $data->avatar,
        ];
    }
}
