<?php

namespace App\Http\Resources\Avatar;

use App\Models\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvatarUserCollectionResouce extends
    JsonResource
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
            'data'    => $this->collection,
        ];
    }
}
