<?php

namespace App\Http\Resources\DetailCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailCollectionResource extends JsonResource
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
            'collection_id' => $this->id,
            'collection_name' => $this->title,
            'collection_desc' => $this->description
        ];
    }
}
