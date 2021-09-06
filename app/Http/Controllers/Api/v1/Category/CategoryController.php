<?php

namespace App\Http\Controllers\Api\v1\Category;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Assessment\AssessmentCollection;
use App\Http\Resources\Profile\UserCollection;
use App\Models\Assessment;
use App\Models\Category;
use App\Models\Question;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    /**
     * @param  Request  $request
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        $category = Category::select('id', 'name')->get()->map(function ($query)
        {
            $query['max_daily_attempt_'.$query['id']] = Setting::where('name', 'max_daily_attempt_'.$query['id'])->first()->value ?? 10;
            return $query;
        });

        return $this->returnSuccess($category);
    }
}