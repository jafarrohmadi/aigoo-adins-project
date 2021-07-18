<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Api\BaseController;
use App\Models\UserCollection;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class UserCollectionController extends
    BaseController
{
    /**
     * @param  Request  $request
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user             = UserCollection::where('user_id', me()->id)->first();
            $user->collection = $request->collection;
            $user->save();

            return $this->returnSuccess(['collection' => json_decode($user->collection)]);
        } catch (\Exception $e) {
            return $this->returnFalse();
        }
    }
}
