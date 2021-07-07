<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Request\User\LoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
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

    public function profile()
    {
        if ($user = me())
        {
            return $this->returnSuccess($user);
        }

        return $this->returnFalse('Unauthorised');
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