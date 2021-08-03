<?php

namespace App\Http\Controllers\Api\v1\Guild;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Guild\GuildCollection;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuildController extends BaseController
{
    public function index(Request $request)
    {
        $data = Department::where('id', me()->department_id)->with([
            'leader',
            'user',
        ])->first();

        return new GuildCollection($data);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Department::find($id);
            $data->team_icon = $this->saveImage($request->team_icon, 'profile_picture');
            $data->save();

            return new GuildCollection($data);
        } catch (Exception $e) {
            return $this->returnFalse();
        }
    }
}
