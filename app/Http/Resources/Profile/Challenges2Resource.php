<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class Challenges2Resource extends JsonResource
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
            'challenger_id' => $this->user_id1,
            'name' => $this->user1Challenges->name,
            'level' => $this->user1Challenges->level,
            'challenge_id' => $this->user_id2,
            'challenge_date_made' => $this->date,
            'challenger_score' => $this->score_player1,
            'difficulty' => $this->difficulty,
            'departement' => $this->user1Challenges->department,
            'status' => $this->status,
        ];
    }
}
