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

class AssessmentController extends
    BaseController
{
    /**
     * @return AssessmentCollection
     */
    public function index(Request $request)
    {
        $question = Question::paginate($request->limit ?? 10);

        return new AssessmentCollection($question);
    }

    /**
     * @param  Request  $request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
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
            return $this->returnFalse();
        }

        return $this->returnSuccess([]);
    }

    /**
     * @param  Request  $request
     * @return UserCollection
     */
    public function getAssessmentUser(Request $request)
    {
        $alreadyAssessment = Assessment::where(['assessor_id'           => me()->id,
                                                'assessment_year_month' => date('Y-m'),
        ])->pluck('user_id')->toArray();

        if (isset($request->name)) {
            $user = User::where('id', '!=', me()->id)->where('name', 'like', "%$request->name%");
        }

        if (!isset($request->name)) {
            $user = User::where('id', '!=', me()->id);

        }
        if ($alreadyAssessment) {
            $user = $user->whereNotIn('id', $alreadyAssessment);
        }

        return new UserCollection($user->inRandomOrder()->paginate($request->limit ?? 10));
    }

}
