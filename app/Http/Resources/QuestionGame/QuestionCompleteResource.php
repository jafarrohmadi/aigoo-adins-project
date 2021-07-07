<?php

namespace App\Http\Resources\QuestionGame;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionCompleteResource extends JsonResource
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
            'question' => $this->question,
            'choose1' => $this->choice1,
            'choose2' => $this->choice2,
            'choose3' => $this->choice3,
            'choose4' => $this->choice4,
            'choose5' => $this->choice5,
            'choose6' => $this->choice6,
            'answer' => json_decode($this->answer)
        ];
    }
}
