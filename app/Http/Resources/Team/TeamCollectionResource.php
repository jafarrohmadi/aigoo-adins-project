<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamCollectionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => [
                'team_name' => $this->team_name,
                'team_icon' => (asset('img/profile_picture').'/'). $this->team_icon ?? 'default_team_avatar.png',
            ],
        ];
    }
}
