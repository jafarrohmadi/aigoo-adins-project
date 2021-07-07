<?php

namespace App\Http\Resources\QuestionGame1;

use App\QuestionComplete;
use App\QuestionMatch;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionGame1Collection extends ResourceCollection
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
            'data' => [
                'choose' => QuestionsChoicesResource::collection($this->collection),
                'complete' => QuestionCompleteResource::collection(QuestionComplete::all()),
                'matching' => QuestionMatchResource::collection(QuestionMatch::all())
            ]
        ];
    }
}
