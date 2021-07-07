<?php

namespace App\Http\Resources\Prizes;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrizesCollection extends ResourceCollection
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
            'data' =>  PrizesResource::collection($this->collection)
        ];
    }
}
