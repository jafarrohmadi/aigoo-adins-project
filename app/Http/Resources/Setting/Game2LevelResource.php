<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class Game2LevelResource extends JsonResource
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
            'difficulty' => $this->difficulty,
            'to_unlock_hi_score' => $this->to_unlock_hi_score,
            'timer' => $this->timer,
            'enemy_count' => $this->enemy_count,
            'score_multiplier' => (float)$this->score_multiplier,
            'track_name' => $this->track_name,
            'win_challange_bonus' => $this->win_challange_bonus,
            'lose_challange_bonus' => $this->lose_challange_bonus,
            'win_outbox_challange_bonus' => $this->win_outbox_challange_bonus,
            'lose_outbox_challange_bonus' => $this->lose_outbox_challange_bonus
        ];
    }
}
