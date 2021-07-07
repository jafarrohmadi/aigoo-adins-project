<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class Challenges1Resource extends JsonResource
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
            'challenger_id' => $this->user_id2,
            'name' => $this->user2Challenges->name,
            'level' => $this->user2Challenges->level,
            'challenge_id' => $this->user_id1,
            'challenge_date_made' => $this->date,
            'challenger_score' => $this->score_player1,
            'difficulty' => $this->difficulty,
            'departement' => $this->user2Challenges->department,
            'status' => $this->status,
        ];
    }
}
