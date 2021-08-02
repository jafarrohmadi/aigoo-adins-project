<?php

namespace App\Http\Resources\Guild;

use App\Http\Resources\Profile\UserCollectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GuildCollection extends
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
                'guild_general_data' => [
                    'department' => $this->name,
                    'guild_name' => $this->team_name,
                    'level'      => $this->level ?? 1,
                ],
                'guild_leader_data'  => new GuildUserResource($this->leader),
                'member_list_data'   => GuildUserResource::collection($this->user),
            ],

        ];
    }
}
