<?php

namespace App\Http\Resources\Leaderboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LeaderboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'player_id' => $this->user->id,
            'display_name' => $this->user->display_name,
            'department' => $this->user->department,
            'score' => (float)$this->total_score,
            'count' => $this->count,
            'level' => $this->user->level,
            'rank' => $this->rank,
            'profile_picture' => $this->user->profile_picture
        ];
    }
}
