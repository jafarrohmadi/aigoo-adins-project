<?php

namespace App\Http\Resources\Setting;

use App\Models\Category;
use App\TitleLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class GlobalSettingsCollection extends ResourceCollection
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        foreach (Category::all() as $categories){
            $gameSettings['max_daily_attempt_'.$categories->id] = $this->collection->where('name', 'max_daily_attempt_'.$categories->id)->first()->value ?? 10;
        }

        return [
            'status'  => true,
            'message' => 'Success',
            'data' => [
                'game_settings' => $gameSettings ?? 'No Data',
                'platform' => [
                    'titles' => TitleResource::collection($this->collection->where('group_name', 'title_level'))
                ],
            ]
        ];
    }
}
