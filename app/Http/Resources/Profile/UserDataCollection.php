<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;


class UserDataCollection extends
    JsonResource
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
            'data'    => [
                'player_id'        => $this->id,
                'username'         => $this->name,
                'department'       => $this->department,
                'level'            => $this->level,
                'coins'            => $this->pointHistories->sum('score'),
                'points'           => $this->pointHistories->where('point', '>=', 0)->sum('point'),
                'current_points'   => $this->pointHistories->sum('point'),
                'avatar_user_data' => $this->avatars ? json_decode($this->avatars->avatar_settings) : '',
            ],
        ];
    }
}
