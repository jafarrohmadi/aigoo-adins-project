<?php

namespace App\Http\Resources\QuestionGame1;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsChoicesResource extends JsonResource
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
            'difficulty' => $this->difficulty,
            'has_image' => 0,
            'question' => $this->question,
            'choice1' => $this->choice1,
            'choice2' => $this->choice2,
            'choice3' => $this->choice3,
            'choice4' => $this->choice4,
            'choice5' => $this->choice5,
            'answer' => $this->answer,
            'image' => $this->image,
            'question' => $this->question
        ];
    }
}
