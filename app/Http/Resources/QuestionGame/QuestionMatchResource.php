<?php

namespace App\Http\Resources\QuestionGame;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionMatchResource extends JsonResource
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
            'wrong_question' => $this->wrong_question,
            'answer' => $this->answer,
            'wrong_answer' => $this->wrong_answer
        ];
    }
}
