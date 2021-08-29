<?php

namespace App\Http\Controllers\Api\v1\Quiz;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\QuestionGame\QuestionGameCollection;
use App\Models\PointHistory;
use App\Models\QuizResult;
use App\Models\User;
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
            $result                  = new PointHistory();
            $result->user_id         = me()->id;
            $result->team_id         = me()->department_id;
            $result->quiz_ID         = $request->get('quiz_ID');
            $result->coins           = $request->get('coins');
            $result->point           = $request->get('point');
            $result->info            = ($request->has('info')) ? $request->get('info') : null;
            $result->date_year_month = date('Y-m');
            $result->save();

            $user        = User::find(me()->id);
            $user->level = $request->level;
            $user->save();

            if(isset($request->result))
            {
                foreach (json_decode($request->result) as $quizResult)
                {
                    $quiz = new QuizResult();
                    $quiz->quiz_id = $quizResult->question_ID;
                    $quiz->type = $quizResult->type;
                    $quiz->user_id = me()->id;
                    $quiz->value = $quizResult->value;
	                $quiz->save();
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnFalse($e->getMessage());
        }

        DB::commit();


        return $this->returnSuccess($result);
    }
}