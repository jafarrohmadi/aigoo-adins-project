<?php

namespace App\Http\Resources\Setting;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserQuizDataResource extends
    ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $setting = Setting::where('group_name', 'game_settings')->get();
        return [
            'daily_attempt_corevalue'   => $this->collection->where('quiz_ID', '2')->first() ?
                (int)$setting[1]->value - $this->collection->where('quiz_ID', '2')[0]->attempt : (int)$setting[1]->value,
            'daily_attempt_dna'          => $this->collection->where('quiz_ID', '1')->first() ?
                (int)$setting[0]->value - $this->collection->where('quiz_ID', '1')[0]->attempt : (int)$setting[0]->value,
            'daily_attempt_collaborate' => $this->collection->where('quiz_ID', '3')->first() ?
                (int)$setting[2]->value - $this->collection->where('quiz_ID', '3')[0]->attempt : (int)$setting[2]->value,
        ];
    }
}
