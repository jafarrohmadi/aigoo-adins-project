<?php

namespace App\Http\Resources\Prizes;

use Illuminate\Http\Resources\Json\JsonResource;

class PrizesResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'code' => $this->code,
            'link' => $this->link,
            'image' => env('MEDIA').$this->image
        ];
    }
}
