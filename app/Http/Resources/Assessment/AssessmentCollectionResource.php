<?php

namespace App\Http\Resources\Assessment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'question_id' => $this->id,
            'category'    => $this->category,
            'title'       => $this->title,
            'content'     => $this->content,
            'score_1'     => $this->choice1,
            'score_2'     => $this->choice2,
            'score_3'     => $this->choice3,
            'score_4'     => $this->choice4,
        ];
    }
}
