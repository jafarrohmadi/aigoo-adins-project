<?php

namespace App\Http\Resources\Profile;

use App\Models\UserCollection;
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
        $userCollection = UserCollection::where('user_id', me()->id)->first();
        if (!$userCollection) {
            $userCollection = UserCollection::create([
                'user_id'    => me()->id,
                'collection' => [
                    'owned_hair'     => [],
                    'owned_headgear' => [],
                    'owned_top'      => [],
                    'owned_bottom'   => [],
                    'owned_shoe'     => [],
                    'owned_hand'     => [],
                    'owned_BG'       => [],
                ],
            ]);
        }

        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => [
                'player_id'        => $this->id,
                'username'         => $this->username,
                'name'             => $this->name,
                'department'       => $this->department,
                'level'            => $this->level,
                'coins'            => $this->pointHistories->sum('coins'),
                'points'           => $this->pointHistories->where('point', '>=', 0)->sum('point'),
                'current_points'   => $this->pointHistories->sum('point'),
                'avatar_user_data' => $this->avatars ?
                    array_merge($this->avatars->avatar_settings, $userCollection['collection']) : '',
            ],
        ];
    }
}
