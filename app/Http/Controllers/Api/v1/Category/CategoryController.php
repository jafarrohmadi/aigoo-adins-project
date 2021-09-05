<?php

namespace App\Http\Controllers\Api\v1\Category;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Assessment\AssessmentCollection;
use App\Http\Resources\Profile\UserCollection;
use App\Models\Assessment;
use App\Models\Category;
use App\Models\Question;
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
        return $this->returnSuccess(Category::select('id', 'name')->get());
    }
}