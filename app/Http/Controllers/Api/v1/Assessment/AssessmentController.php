<?php

namespace App\Http\Controllers\Api\v1\Assessment;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Assessment\AssessmentCollection;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssessmentController extends BaseController
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
            foreach (json_decode($request->question) as $question) {
                Assessment::create([
                    'assessor_id'           => me()->id,
                    'user_id'               => $request->user_id,
                    'question_id'           => $question->question_id,
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
