<?php

namespace App\Http\Resources\UserPrizes;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPrizesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'  => true,
            'message' => 'Success',
            'data' =>  UserPrizesResource::collection($this->collection)
        ];
    }
}
