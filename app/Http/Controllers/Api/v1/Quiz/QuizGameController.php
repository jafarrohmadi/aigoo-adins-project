<?php

namespace App\Http\Controllers\Api\v1\Quiz;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\QuestionGame\QuestionGameCollection;
use App\Models\PointHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizGameController extends
    BaseController
{
    public function index($category)
    {
        if ($category) {
            return new QuestionGameCollection(['category' => $category]);
        } else {
            return $this->returnFalse();
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $result          = new PointHistory();
            $result->user_id = me()->id;
            $result->team_id = me()->department_id;
            $result->game_id = $request->get('game_id');
            $result->score   = $request->get('score');
            $result->point   = $request->get('point');
            $result->info    = ($request->has('info')) ? $request->get('info') : null;
            $result->save();

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnFalse($e->getMessage());
        }

        DB::commit();

        return $this->returnSuccess($result);
    }
}