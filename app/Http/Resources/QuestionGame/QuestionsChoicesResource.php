<?php

namespace App\Http\Resources\QuestionGame;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsChoicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'question_id' => $this->id,
            'question'    => $this->question,
            'choice1'     => $this->choice1,
            'choice2'     => $this->choice2,
            'choice3'     => $this->choice3,
            'choice4'     => $this->choice4,
            'choice5'     => $this->choice5,
            'answer'      => $this->answer,
        ];
    }
}
