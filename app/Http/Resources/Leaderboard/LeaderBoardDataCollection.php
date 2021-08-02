<?php

namespace App\Http\Resources\Leaderboard;

use App\Models\User;
use App\ViewModels\VwLeadeboard;
use App\ViewModels\VwLeaderboardGuild;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LeaderBoardDataCollection extends
    ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userTotalScore = Cache::remember('userTotalScore'. me()->id, 300, function () {
            return User::find(me()->id)->pointHistories->where('point', '>=', 0)->sum('point');
        });

        $nationalData   = Cache::remember('nationalData'. me()->id, 300, function () {
            return VwLeadeboard::with('user', 'user.pointHistories')->orderBy('total_points', 'desc')->get();
        });

        $regionalData   = Cache::remember('regionalData'. me()->id, 300, function () use ($nationalData) {
            return $nationalData->where('team_id', me()->department_id);
        });

        $guildData      = Cache::remember('guildData'. me()->id, 300, function () {
            return VwLeaderboardGuild::with('department', 'department.leader', 'department.pointHistories')->orderBy('total_points',
                'desc')->get();
        });

        $ownPlaceRegional = Cache::remember('ownPlaceRegional'. me()->id, 300, function ()  use ($regionalData, $userTotalScore) {
            return count($regionalData->where('total_points', '>', $userTotalScore)) + 1;
        });

        $ownPlaceNational = Cache::remember('ownPlaceNational'. me()->id, 300, function ()  use ($nationalData, $userTotalScore) {
            return count($nationalData->where('total_points', '>', $userTotalScore)) + 1;
        });

        $ownPlaceGuild = Cache::remember('ownPlaceGuild'. me()->id , 300, function () use ($nationalData, $userTotalScore){
           return count($nationalData->where('total_points', '>', $userTotalScore)) + 1;
        });
        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => [
                'regional' => [
                    'own_place'        => $ownPlaceRegional,
                    'leaderboard_data' => LeaderBoardUserResource::collection($regionalData),
                ],

                'national' => [
                    'own_place'        => $ownPlaceNational,
                    'leaderboard_data' => LeaderBoardUserResource::collection($nationalData),
                ],

                'guild'    => [
                    'own_place'        => $ownPlaceGuild,
                    'leaderboard_data' => LeaderBoardUserGuildResource::collection($guildData),
                ],
            ],
        ];

    }
}
