<?php

namespace App\Http\Controllers\Api\v1\Avatar;

use App\Http\Controllers\Api\BaseController;
use App\Http\Request\Avatar\AvatarRequest;
use App\Http\Resources\Avatar\AvatarResource;
use App\Http\Resources\Avatar\AvatarUserCollectionResouce;
use App\Models\Avatar;
use App\Models\User;
use App\Models\UserCollection;
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
    public function storeOrUpdate(Request $request)
    {
        $avatarSettings = [
            'equiped_hair'     => $request->equiped_hair,
            'equiped_headgear' => $request->equiped_headgear,
            'equiped_top'      => $request->equiped_top,
            'equiped_bottom'   => $request->equiped_bottom,
            'equiped_shoe'     => $request->equiped_shoe,
            'equiped_hand'     => $request->equiped_hand,
            'equiped_BG'       => $request->equiped_BG,
            'equiped_face_acc' => $request->equiped_face_acc
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

    public function buyNewAvatar(Request $request)
    {
        $userCollection = UserCollection::where('user_id', me()->id)->first();
        $data           = [];
        foreach ($userCollection->collection as $key => $collectionData) {
            if (($request->avatarPartID == 1 && $key == 'owned_hair')
                || ($request->avatarPartID == 2 && $key == 'owned_headgear')
                || ($request->avatarPartID == 3 && $key == 'owned_top')
                || ($request->avatarPartID == 4 && $key == 'owned_bottom')
                || ($request->avatarPartID == 5 && $key == 'owned_shoe')
                || ($request->avatarPartID == 6 && $key == 'owned_hand')
                || ($request->avatarPartID == 7 && $key == 'owned_BG')
                || ($request->avatarPartID == 8 && $key == 'owned_face_acc')) {
                array_push($collectionData, $request->item_ID);
            }

            $data[$key] = array_unique($collectionData);
        }

        $userCollection->collection = $data;

        $userCollection->save();

        $user               = User::find(me()->id);
        $user->current_coin = $request->current_coin;
        $user->save();

        return new AvatarUserCollectionResouce($userCollection);
    }
}
