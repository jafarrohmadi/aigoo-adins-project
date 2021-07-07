<?php

namespace App\Http\Resources\SearchChallengers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchChallengersCollection extends ResourceCollection
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
            'data' =>  SearchChallengersResource::collection($this->collection)
        ];
    }
}
