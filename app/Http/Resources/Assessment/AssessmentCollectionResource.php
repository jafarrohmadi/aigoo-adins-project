<?php

namespace App\Http\Resources\Assessment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentCollectionResource extends
    JsonResource
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
            'category'    => $this->nameCategory ?? $this->category,
            'title'       => $this->title,
            'content'     => $this->content,
            'criteria_1'  => $this->choice1,
            'point_1'     => $this->point1,
            'criteria_2'  => $this->choice2,
            'point_2'     => $this->point1,
            'criteria_3'  => $this->choice3,
            'point_3'     => $this->point1,
            'criteria_4'  => $this->choice4,
            'point_4'     => $this->point1,
        ];
    }
}
