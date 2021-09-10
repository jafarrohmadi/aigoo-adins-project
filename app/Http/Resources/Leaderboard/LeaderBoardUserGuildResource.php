<?php

namespace App\Http\Resources\Leaderboard;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaderBoardUserGuildResource extends
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
        $date = $request->date ?? date('Y-m');

        return [
            'department' => $this->department->name ?? '',
            'guild_name' => $this->department->team_name ?? '',
            'leader' => $this->department->leader->name ?? '',
            'points' => $this->department->pointHistories->where('point', '>=', 0)->where('date_year_month', $date)->avg('point'),
            'profilePict' => (asset('img/profile_picture').'/').$this->department->team_icon,

        ];
    }
}
