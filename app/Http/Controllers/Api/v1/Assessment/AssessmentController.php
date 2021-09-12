<?php

namespace App\Http\Controllers\Api\v1\Assessment;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Assessment\AssessmentCollection;
use App\Http\Resources\Profile\UserCollection;
use App\Models\Assessment;
use App\Models\PointHistory;
use App\Models\Question;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AssessmentController extends
    BaseController
{
    /**
     * @return AssessmentCollection
     */
    public function index(Request $request)
    {
        $question = Question::where('level', 'like', '%'.me()->roles.'%')->paginate($request->limit ?? 10);

        return new AssessmentCollection($question);
    }

    /**
     * @param  Request  $request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $assessment = Assessment::where([
                'assessor_id'           => me()->id,
                'user_id'               => $request->user_ID,
                'assessment_year_month' => date('Y-m'),
            ])->first();

            if ($assessment) {
                return $this->returnFalse('Already given an assessment this month');
            }

            foreach (json_decode($request->result) as $question) {
                Assessment::create([
                    'assessor_id'           => me()->id,
                    'user_id'               => $request->user_ID,
                    'question_id'           => $question->question_ID,
                    'value'                 => $question->value,
                    'assessment_year_month' => date('Y-m'),
                ]);
            }

            PointHistory::create([
                'user_id'         => me()->id,
                'team_id'         => me()->department_id,
                'quiz_ID'         => 0,
                'coins'           => $request->coins,
                'point'           => 0,
                'info'            => 'Assessment Data',
                'date_year_month' => date('Y-m'),
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnFalse();
        }
        DB::commit();
        return $this->returnSuccess([]);
    }

    /**
     * @param  Request  $request
     * @return UserCollection
     */
    public function getAssessmentUser(Request $request)
    {
        $user = User::with('assessmentAssessor');

        if (isset($request->name)) {
            $user = $user->where('name', 'like', "%$request->name%");
        }

        return new UserCollection($user->inRandomOrder()->paginate($request->limit ?? 10));
    }

}
