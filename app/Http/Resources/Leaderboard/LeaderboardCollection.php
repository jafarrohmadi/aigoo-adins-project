<?php

namespace App\Http\Resources\Leaderboard;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class LeaderboardCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $self_rank = $this->collection->filter(function ($value) {
            return $value->user_id == Auth::id();
        });

        if(count($self_rank) != 0):
            $self_rank = $self_rank->keys()->first() + 1;
        else:
            $self_rank = 0;
        endif;

        // Calculate rank each player, the idea is using key from array
        foreach($this->collection as $key => $collection)
            $this->collection[$key]['rank'] = $key + 1;

        return [
            'status'  => true,
            'message' => 'Success',
            'data' =>  [
                'leaderboard' => LeaderboardResource::collection($this->collection),
                'player_rank' => [
                    'rank' => (int)$self_rank
                ]
            ]
        ];
    }
}
