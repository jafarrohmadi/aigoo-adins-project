<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'id'        => $this->id ?? '',
            'name'      => $this->name ?? '',
            'team_name' => $this->team_name ?? '',
            'team_icon' => $this->team_icon ?? '',
        ];
    }
}
