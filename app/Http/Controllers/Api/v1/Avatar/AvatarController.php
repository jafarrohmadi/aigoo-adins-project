<?php

namespace App\Http\Controllers\Api\v1\Avatar;

use App\Http\Controllers\Api\BaseController;
use App\Http\Request\Avatar\AvatarRequest;
use App\Http\Resources\Avatar\AvatarResource;
use App\Models\Avatar;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AvatarController extends
    BaseController
{
    /**
     * @return AvatarResource|ResponseFactory|Response
     */
    public function index()
    {
        $avatar = Avatar::where('user_id', me()->id)->first();

        if ($avatar) {
            return new AvatarResource($avatar);
        } else {
            return $this->returnFalse();
        }
    }

    /**
     * @param  AvatarRequest  $request
     * @return AvatarResource|ResponseFactory|Response
     */
    public function storeOrUpdate(AvatarRequest $request)
    {
        $avatarSettings = [
            'equiped_hair'     => $request->equiped_hair,
            'equiped_headgear' => $request->equiped_headgear,
            'equiped_top'      => $request->equiped_top,
            'equiped_bottom'   => $request->equiped_bottom,
            'equiped_shoe'     => $request->equiped_shoe,
            'equiped_hand'     => $request->equiped_hand,
            'equiped_BG'       => $request->equiped_BG,
        ];

        try {
            $avatar = Avatar::where('user_id', me()->id)->first();

            if (!$avatar) {
                $avatar = new Avatar();
            }

            $avatar->user_id         = me()->id;
            $avatar->avatar_settings = $avatarSettings;
            $avatar->save();

            return new AvatarResource($avatar);

        } catch (\Exception $exception) {
            return $this->returnFalse();
        }
    }
}
