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
        $date  = $request->date ?? date('Y-m');
        $limit = $request->max_user ?? 10;
        $page  = $request->page ?? 1;

        $userTotalScore = Cache::remember('userTotalScore'.me()->id.$date, 300, function () use ($date)
        {
            return User::find(me()->id)->pointHistories->where('point', '>=', 0)->where('date_year_month',
                $date)->sum('point');
        });

        $userGuildScore = Cache::remember('userGuildScore'.me()->id.$date, 300, function () use ($date)
        {
            return VwLeaderboardGuild::where('team_id', me()->department_id)->where('date', $date)->sum('total_points');
        });


        $nationalData = Cache::remember('nationalData'.me()->id.$date.$page.$limit, 300, function () use ($date, $limit)
        {
            return VwLeadeboard::with('user', 'user.pointHistories')
                ->where('date', $date)
                ->orderBy('total_points', 'desc')
                ->paginate($limit);
        });

        $regionalData = Cache::remember('regionalData'.me()->id.$date.$page.$limit, 300, function () use ($date, $limit) {
            return VwLeadeboard::with('user', 'user.pointHistories')
                ->where('date', $date)
                ->where('team_id', me()->department_id)
                ->orderBy('total_points', 'desc')
                ->paginate($limit);
        });

        $guildData = Cache::remember('guildData'.me()->id.$date, 300, function () use ($date)
        {
            return VwLeaderboardGuild::with('department', 'department.leader', 'department.pointHistories')
                ->where('date', $date)
                ->orderBy('total_points', 'desc')
                ->get();
        });

        $ownPlaceRegional = Cache::remember('ownPlaceRegional'.me()->id, 300, function () use ($userTotalScore, $date)
        {
            return VwLeadeboard::where('team_id', me()->department_id)
                    ->where('date', $date)
                    ->orderBy('total_points', 'desc')
                    ->where('total_points', '>', $userTotalScore)
                    ->count() + 1;
        });

        $ownPlaceNational = Cache::remember('ownPlaceNational'.me()->id, 300, function () use ($userTotalScore, $date)
        {
            return VwLeadeboard::where('total_points', '>', $userTotalScore)
                    ->where('date', $date)
                    ->orderBy('total_points', 'desc')
                    ->count() + 1;
        });

        $ownPlaceGuild = Cache::remember('ownPlaceGuild'.me()->id, 300, function () use ($guildData, $userTotalScore)
        {
            return count($guildData->where('total_points', '>', $userTotalScore)) + 1;
        });

        return [
            'status'  => true,
            'message' => 'Success',
            'data'    => [
                'regional' => [
                    'own_place'        => $ownPlaceRegional,
                    'own_point'        => $userTotalScore,
                    'leaderboard_data' => LeaderBoardUserResource::collection($regionalData),
                ],

                'national' => [
                    'own_place'        => $ownPlaceNational,
                    'own_point'        => $userTotalScore,
                    'leaderboard_data' => LeaderBoardUserResource::collection($nationalData),
                ],

                'guild' => [
                    'own_place'        => $ownPlaceGuild,
                    'own_point'        => $userGuildScore,
                    'leaderboard_data' => LeaderBoardUserGuildResource::collection($guildData),
                ],
            ],
        ];

    }
}
