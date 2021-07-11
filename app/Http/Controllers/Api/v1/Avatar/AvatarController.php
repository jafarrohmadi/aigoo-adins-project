<?php

namespace App\Http\Controllers\Api\v1\Avatar;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Avatar\AvatarCollectionResource;
use App\Models\Avatar;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AvatarController extends BaseController
{
    /**
     * @return AvatarCollectionResource|ResponseFactory|Response
     */
    public function index()
    {
        $avatar = Avatar::where('user_id', me()->id)->first();

        if ($avatar) {
            return new AvatarCollectionResource($avatar);
        } else {
            return $this->returnFalse();
        }
    }

    /**
     * @param  Request  $request
     * @return AvatarCollectionResource|ResponseFactory|Response
     */
    public function storeOrUpdate(Request $request)
    {
        try {
            $avatar = Avatar::updateOrCreate(['avatar_settings' => $request->avatar_settings, 'user_id' => me()->id], [
                'user_id' => me()->id,
            ]);

            return new AvatarCollectionResource($avatar);

        } catch (\Exception $exception) {
            return $this->returnFalse();
        }
    }
}
