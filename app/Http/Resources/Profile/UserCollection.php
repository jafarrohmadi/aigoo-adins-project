<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
            'data'    => ['user_list' => UserCollectionResource::collection($this->collection)]
        ];
    }
}
