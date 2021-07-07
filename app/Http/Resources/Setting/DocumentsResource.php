<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentsResource extends JsonResource
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
            'doc_id' => $this->id,
            'title' => $this->title,
            'short_desc' => $this->short_desc,
            'download_link' => $this->download_link
        ];
    }
}
