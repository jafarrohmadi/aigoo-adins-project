<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class Game1LevelResource extends JsonResource
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
            'time' => $this->time,
            'total_question' => $this->total_question,
            'to_unlock_hi_score' => $this->to_unlock_hi_score,
            'score_multiplier' => $this->score_multiplier
        ];
    }
}
