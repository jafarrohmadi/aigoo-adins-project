<?php

namespace App\Http\Controllers\Api\v1\Guild;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Guild\GuildCollection;
use App\Models\Department;
use Illuminate\Http\Request;

class GuildController extends BaseController
{
    public function index(Request $request)
    {
        $data = Department::where('id', me()->department_id)->with(['leader', 'user'])->first();

        return new GuildCollection($data);
    }
}
