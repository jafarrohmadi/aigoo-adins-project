<?php

namespace App\Http\Resources\Profile;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCollectionResource extends
    JsonResource
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
            'user_ID'     => $this->id,
            'name'        => $this->name,
            'department'  => $this->department,
            'status'      => (new \App\Models\User)->getUserStatus($this->assessmentAssessor->where('assessment_year_month', date('Y-m'))->first() ? 0 : 1),
            'profilePict' => (asset('img/profile_picture').'/').$this->change_avatar ?? $this->avatar,
            'userLevel'   => $this->roles,
        ];
    }
}
