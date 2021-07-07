<?php

namespace App\Http\Resources\UserPrizes;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPrizesResource extends JsonResource
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
            'id' => $this->id,
            'prize_id' => $this->prize_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'status' => $this->status
        ];
    }
}
