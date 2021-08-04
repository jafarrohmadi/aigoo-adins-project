<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Request\User\LoginRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Profile\UserCollection;
use App\Http\Resources\Profile\UserDataCollection;
use App\Models\Assessment;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
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
            if (Auth::attempt(['email' => $request->username, 'password' => $request->password]))
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

    public function getUserData()
    {
        try
        {
            return new UserDataCollection(me());
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
            return $this->returnFalse();
        }
    }

    public function addAllUser(Request $request)
    {
        $url = config('app.api_adins_url');
        $key = config('app.api_adins_key');
        $value = config('app.api_adins_value');

        $client = new Client(['headers' => [$key => $value]]);
//        $request_param = [
//            'username'    => $request->username,
//            'password'         => $request->password,
//        ];
//        $request_data = json_encode($request_param);
        $res = $client->request(
            'GET',
            url($url.'/api/employee'),
            [
                'headers' => [
                    'Accept'     => 'application/json'
                ],
//                'body'   => $request_data
            ]
        );

        return $res->getBody()->getContents();
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