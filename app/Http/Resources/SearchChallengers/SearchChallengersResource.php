<?php

namespace App\Http\Resources\SearchChallengers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchChallengersResource extends JsonResource
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
            'divisi' => $this->department,
            'player_id' => $this->id,
            'display_name' => $this->display_name,
            'profile_picture' => $this->profile_picture,
            'level' => $this->level,
            'challenged_count' => $this->challenges2->where('user_id2', $this->id)->whereIn('status', ['Accept', 'Finish'])->count()
        ];
    }
}
