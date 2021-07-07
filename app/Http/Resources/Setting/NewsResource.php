<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'news_id' => $this->id,
            'title' => $this->title,
            'detail' => $this->detail,
            'download_link' => $this->download_link
        ];
    }
}
