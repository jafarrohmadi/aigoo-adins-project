<?php

namespace App\Http\Resources\Guild;

use Illuminate\Http\Resources\Json\JsonResource;

class GuildUserResource extends
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
            'name'        => $this->name,
            'status'      => (new \App\Models\User)->getUserStatus($this->active),
            'level'       => $this->level,
            'points'      => $this->pointHistories->where('point', '>=', 0)->sum('point'),
            'profilePict' => (asset('img/profile_picture').'/').$this->change_avatar ?? $this->avatar,
        ];
    }
}
