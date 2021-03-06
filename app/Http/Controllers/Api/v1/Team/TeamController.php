<?php

namespace App\Http\Controllers\Api\v1\Team;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Team\TeamCollectionResource;
use App\Models\Department;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends BaseController
{
    /**
     * @param  Request  $request
     * @return TeamCollectionResource|ResponseFactory|Response
     */
    public function update(Request $request)
    {
        try {
            $department            = Department::find(me()->department_id);
            $department->team_name = $request->team_name;
            $department->team_icon = $this->saveImage($request->team_icon, 'profile_picture');
            $department->save();

            return new TeamCollectionResource($department);
        } catch (\Exception $exception) {
            return $this->returnFalse();
        }
    }
}