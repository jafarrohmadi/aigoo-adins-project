<?php

namespace App\Http\Resources\QuestionGame2;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionTrueFalseResource extends JsonResource
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
            'question_id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer
        ];
    }
}
