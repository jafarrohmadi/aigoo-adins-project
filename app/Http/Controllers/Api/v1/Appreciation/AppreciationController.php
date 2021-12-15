<?php

namespace App\Http\Controllers\Api\v1\Appreciation;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Assessment\AssessmentCollection;
use App\Http\Resources\Profile\UserCollection;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class AppreciationController extends
    BaseController
{
    /**
     * @param  Request  $request
     * @return UserCollection
     */
    public function index(Request $request)
    {
        $user = User::where('id', '!=', me()->id)->where('id', '!=', 1);
        if (isset($request->name))
        {
            $user = $user->where('name', 'like', "%$request->name%");
        }

        if (isset($request->department_id))
        {
            $user = $user->where('department_id', $request->department_id);
        }

        return new UserCollection($user->inRandomOrder()->paginate($request->limit ?? 10));
    }

    /**
     * @param  Request  $request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
        try {
            Assessment::create([
                'assessor_id'           => me()->id,
                'user_id'               => $request->user_ID,
                'assessment_year_month' => date('Y-m'),
                'assessment_info'       => $request->message,
                'value'                 => $request->value,
            ]);
        } catch (\Exception $exception) {
            return $this->returnFalse();
        }

        return $this->returnSuccess([]);
    }

}
