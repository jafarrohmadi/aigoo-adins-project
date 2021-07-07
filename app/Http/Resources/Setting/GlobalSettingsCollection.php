<?php

namespace App\Http\Resources\Setting;

use App\Collection;
use App\Document;
use App\Game1Level;
use App\Game2Level;
use App\News;
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
        $collections = Collection::all();
        $todaySchedule = DB::table('schedules')->whereDate('date_from', Carbon::today())->whereDate('date_to', Carbon::today())->get();

        return [
            'status'  => true,
            'message' => 'Success',
            'data' => [
                'exp_table' => ExpResource::collection($this->collection->where('category', 'exp_table')),
                'platform' => [
                    'can_redeem_point' => $this->collection->firstWhere('category', 'platform')->value,
                    'titles' => TitleResource::collection(TitleLevel::all())
                ],
                'game1_settings' => [
                    'max_daily_attempt' => $this->collection->firstWhere('category', 'game1_settings')->value,
                    'levels' => Game1LevelResource::collection(Game1Level::all())
                ],
                'game2_settings' => [
                    'life' => $this->collection->where('category', 'game2_settings')->firstWhere('name', 'life')->value,
                    'max_challange_accepted' => $this->collection->where('category', 'game2_settings')->firstWhere('name', 'max_challange_accepted')->value,
                    'max_daily_attempt' => $this->collection->where('category', 'game2_settings')->firstWhere('name', 'max_daily_attempt')->value,
                    'levels' => Game2LevelResource::collection(Game2Level::all())
                ],
                'game3_settings' => [
                    'max_daily_attempt' => $this->collection->firstWhere('category', 'game3_settings')->value
                ],
                'game4_settings' => [
                    'max_daily_attempt' => $this->collection->firstWhere('category', 'game4_settings')->value,
                    'collection_rarity_common' => $collections->where('category', 'common')->count(),
                    'collection_rarity_rare' => $collections->where('category', 'rare')->count(),
                    'collection_rarity_legendary' => $collections->where('category', 'legendary')->count(),
                    'list_collection_common' => CollectionResource::collection($collections->where('category', 'common')),
                    'list_collection_rare' => CollectionResource::collection($collections->where('category', 'rare')),
                    'list_collection_legendary' => CollectionResource::collection($collections->where('category', 'legendary')),
                    'total_collection' => $collections->count(),
                    'today_schedule' => $todaySchedule->isEmpty() ? 0 : $todaySchedule->first()->marker_id,
                ]
            ]
        ];
    }
}
