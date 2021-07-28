<?php

namespace App\Http\Resources\Setting;

use App\TitleLevel;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class GlobalSettingsCollection extends ResourceCollection
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
            'status'  => true,
            'message' => 'Success',
            'data' => [
                'game_settings' => [
                    'max_daily_attempt_dna' => $this->collection->where('name', 'max_daily_attempt_dna')->value,
                    'max_daily_attempt_corevalue' => $this->collection->where('name', 'max_daily_attempt_corevalue')->value,
                    'max_daily_attempt_collaborate' => $this->collection->where('name', 'max_daily_attempt_collaborate')->value,
                ],
                'platform' => [
                    'titles' => TitleResource::collection($this->collection->where('group_name', 'title_level'))
                ],
            ]
        ];
    }
}
