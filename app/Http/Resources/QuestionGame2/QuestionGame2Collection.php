<?php

namespace App\Http\Resources\QuestionGame2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionGame2Collection extends ResourceCollection
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
            'data' =>  QuestionTrueFalseResource::collection($this->collection)
        ];
    }
}
