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
                'exp_table' => ExpResource::collection($this->collection->where('group_name', 'exp_table')),
                'game_settings' => [
                    'max_daily_attempt' => $this->collection->firstWhere('group_name', 'game_settings')->value,
                ],
                'platform' => [
                    'titles' => TitleResource::collection($this->collection->where('group_name', 'title_level'))
                ],
            ]
        ];
    }
}
