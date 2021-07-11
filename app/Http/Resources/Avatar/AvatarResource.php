<?php

namespace App\Http\Resources\Avatar;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvatarResource extends JsonResource
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
                'avatar_id'       => $this->id,
                'avatar_settings' => json_decode($this->avatar_settings),
            ],
        ];
    }
}
