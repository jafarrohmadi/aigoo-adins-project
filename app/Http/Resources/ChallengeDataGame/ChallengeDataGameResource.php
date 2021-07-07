<?php

namespace App\Http\Resources\ChallengeDataGame;

use App\Http\Resources\Profile\Challenges1Resource;
use App\Http\Resources\Profile\Challenges2Resource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeDataGameResource extends JsonResource
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
            'status'  => true,
            'message' => 'Success',
            'data' => [
                'accepted_challenge_count' => $this->challenges2->where('user_id2', $this->id)->whereIn('status', ['Accept', 'Finish'])->whereBetween('date', [Carbon::parse('-24 hours'), now()])->count(),
                'challenge_in' => Challenges2Resource::collection($this->challenges2->where('status', 'Pending')),
                'challenge_out' => Challenges1Resource::collection($this->challenges1->whereNotIn('status', ['Expire'])),
            ]
        ];
    }
}
