<?php

namespace App\Http\Controllers\Api\v1\LeaderBoard;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Leaderboard\LeaderboardCollection;
use App\ViewModels\VwLeadeboard;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LeaderBoardController extends BaseController
{

    /**
     * @param  Request  $request
     * @return LeaderboardCollection|ResponseFactory|Response
     */
    public function index(Request $request)
    {
        try {
            $leaderBoard = VwLeadeboard::with('user')
                ->setLimit($request->get('limit') ?? 50);

            return new LeaderboardCollection($leaderBoard->get());
        } catch (Exception $e) {
            return $this->returnFalse();
        }
    }
}