<?php

namespace App\Http\Controllers\Api\v1\Assessment;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Assessment\AssessmentCollection;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
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
        } catch (\Exception $exception) {
            return $this->returnFalse();
        }

        return $this->returnSuccess([]);
    }
}
