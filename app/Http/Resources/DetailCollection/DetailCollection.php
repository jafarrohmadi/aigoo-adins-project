<?php

namespace App\Http\Resources\DetailCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DetailCollection extends ResourceCollection
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
            'data' =>  DetailCollectionResource::collection($this->collection)
        ];
    }
}
