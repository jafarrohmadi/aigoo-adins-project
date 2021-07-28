<?php

namespace App\Http\Resources\Avatar;

use App\Models\User;
use App\Models\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvatarResource extends
    JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userCollection = UserCollection::where('user_id', me()->id)->first();
        if (!$userCollection) {
            $userCollection = UserCollection::create([
                'user_id'    => me()->id,
                'collection' => [
                    'owned_hair'     => [],
                    'owned_headgear' => [],
                    'owned_top'      => [],
                    'owned_bottom'   => [],
                    'owned_shoe'     => [],
                    'owned_hand'     => [],
                    'owned_BG'       => [],
                ],
            ]);
        }

        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => ['avatar_user_data' =>array_merge($this->avatar_settings , $userCollection['collection'])],
        ];
    }
}
