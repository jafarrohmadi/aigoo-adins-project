<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Request\User\LoginRequest;
use App\Http\Resources\Profile\ProfileResource;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * @param LoginRequest $request
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                $success['token'] = me()->createToken('authToken')->plainTextToken;

                return $this->returnSuccess($success);

            }
        } catch (\Throwable $th)
        {
            return $this->returnFalse("Something went wrong", $th->getMessage());
        }

        return $this->returnFalse('Unauthorised');
    }

    /**
     * @return ProfileResource|ResponseFactory|\Illuminate\Http\Response
     */
    public function profile()
    {
        try
        {
            return new ProfileResource(me());
        } catch (Exception $e)
        {
            return $this->returnFalse();
        }
    }

    public function updateProfile(Request $request)
    {
        try
        {
            $user = me();
            if ($request->has('avatar'))
            {
                $user->change_avatar = $this->saveImage($request->avatar, 'profile_picture');
            }

            $user->save();

            return new ProfileResource(me());
        } catch (Exception $e)
        {
            DD($e->getMessage());
            return $this->returnFalse();
        }
    }

    /**
     * @return ResponseFactory
     */
    public function logout()
    {
        if ($user = me()->currentAccessToken()->delete())
        {
            return $this->returnSuccess('Success Logout');
        }

        return $this->returnFalse('Unauthorised');
    }
}