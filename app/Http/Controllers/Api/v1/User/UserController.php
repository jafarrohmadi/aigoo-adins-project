<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Request\User\LoginRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Profile\UserCollection;
use App\Http\Resources\Profile\UserDataCollection;
use App\Models\Assessment;
use App\Models\Department;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends
    BaseController
{
    /**
     * @param  LoginRequest  $request
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            $userNameData = $request->username;
            $passwordData = $request->password;

            $request_param = [
                'username' => $userNameData,
                'password' => $passwordData,
            ];

            $request_data = json_encode($request_param);

            $url        = config('app.api_adins_url');
            $key        = config('app.api_adins_key');
            $data_value = config('app.api_adins_value');

            $client = new Client(['headers' => [$key => $data_value]]);

            $res = $client->request(
                'POST', url($url.'/api/auth/ldap'),
                [
                    'headers' => [
                        'Accept'       => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body'    => $request_data,
                ]
            );

            $value = json_decode($res->getBody()->getContents());

            if ($value != "Wrong credentials") {

                $department = Department::where('name', $value->Department)->first();

                if (!$department) {
                    $department            = new Department();
                    $department->name      = $value->Department;
                    $department->is_active = 1;
                    $department->team_name = $value->Department;
                    $department->team_icon = 'default_team_avatar.png';
                    $department->department_code = $value->DepartmentCode;
                    $department->save();
                }

                $user = User::where('email', $userNameData)->first();

                if (!$user) {
                    $user                    = new User();
                    $user->type              = 'user';
                    $user->name              = $value->EmployeeName;
                    $user->email             = $value->Email;
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->password          = Hash::make(substr(md5(mt_rand()), 0, 7));
                    $user->roles             = 'Staff';
                    $user->employee_level_id = 1;
                    $user->active            = 1;
                    $user->team_id           = $department->id;
                    $user->department_id     = $department->id;
                    $user->department        = $value->Department;
                    $user->avatar            = 'default_avatar.png';
                    $user->level             = 1;
                    $user->username          = $value->Email;
                    $user->current_coin      = 0;
                    $user->company           = $value->Company;
                    $user->bu                = $value->BU;
                    $user->subbu             = $value->SubBU;
                    $user->nik               = $value->NIK;
                    $user->jobposition       = $value->JobPosition;
                    $user->worklocationname  = $value->WorkLocationName;
                    $user->statusincompany   = $value->Status ?? '';
                    $user->gender            = $value->Gender == 'Male' ? 0 : 1;
                    $user->save();
                } else {

                    $user->name             = $value->EmployeeName;
                    $user->department       = $value->Department;
                    $user->email            = $value->Email;
                    $user->company          = $value->Company;
                    $user->bu               = $value->BU;
                    $user->subbu            = $value->SubBU;
                    $user->nik              = $value->NIK;
                    $user->jobposition      = $value->JobPosition;
                    $user->worklocationname = $value->WorkLocationName;
                    $user->statusincompany  = $value->Status ?? '';
                    $user->gender           = $value->Gender == 'Male' ? 0 : 1;
                    $user->bu_code          = $value->BUCode ?? '';
                    $user->sub_bu_code      = $value->SubBUCode ?? '';
                    $user->department_code  = $value->DepartmentCode ?? '';
                    $user->job_level        = $value->JobLevel ?? '';
                    $user->save();
                }

            }

            if (Auth::loginUsingId($user->id)) {
                $success['token'] = me()->createToken('authToken')->plainTextToken;

                return $this->returnSuccess($success);
            }
        } catch (\Throwable $th) {
            return $this->returnFalse("Something went wrong", $th->getMessage());
        }

        return $this->returnFalse('Unauthorised');
    }

    /**
     * @return ProfileResource|ResponseFactory|\Illuminate\Http\Response
     */
    public function profile()
    {
        try {
            return new ProfileResource(me());
        } catch (Exception $e) {
            return $this->returnFalse();
        }
    }

    public function getUserData()
    {
        try {
            return new UserDataCollection(me());
        } catch (Exception $e) {
            return $this->returnFalse();
        }
    }

    public function updateProfile(
        Request $request
    ) {
        try {
            $user = me();
            if ($request->has('avatar')) {
                $user->change_avatar = $this->saveImage($request->avatar, 'profile_picture');
            }

            $user->save();

            return new ProfileResource(me());
        } catch (Exception $e) {
            return $this->returnFalse();
        }
    }

    public function addAllUser(
        Request $request
    ) {
        $url   = config('app.api_adins_url');
        $key   = config('app.api_adins_key');
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
                    'Accept' => 'application/json',
                ],
                //                'body'   => $request_data
            ]
        );

        $data = json_decode($res->getBody()->getContents());

        foreach ($data as $key => $value) {
            $department = Department::where('name', $value->Department)->first();
            if (!$department) {
                $department            = new Department();
                $department->name      = $value->Department;
                $department->is_active = 1;
                $department->team_name = $value->Department;
                $department->team_icon = 'default_team_avatar.png';
                $department->save();
            }
            $email = User::where('email', $value->Email)->first();
            if (!$email) {
                $user                    = new User();
                $user->type              = 'user';
                $user->name              = $value->EmployeeName;
                $user->email             = $value->Email;
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->password          = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
                $user->roles             = 'Staff';
                $user->employee_level_id = 1;
                $user->active            = 1;
                $user->team_id           = $department->id;
                $user->department_id     = $department->id;
                $user->department        = $value->Department;
                $user->avatar            = 'default_avatar.png';
                $user->level             = 1;
                $user->username          = $value->Email;
                $user->current_coin      = 0;
                $user->company           = $value->Company;
                $user->bu                = $value->BU;
                $user->subbu             = $value->SubBU;
                $user->nik               = $value->NIK;
                $user->jobposition       = $value->JobPosition;
                $user->worklocationname  = $value->WorkLocationName;
                $user->statusincompany   = $value->Status;
                $user->save();
            }
        }

        return $this->returnSuccess('Success');
    }

    /**
     * @return ResponseFactory
     */
    public function logout()
    {
        if ($user = me()->currentAccessToken()->delete()) {
            return $this->returnSuccess('Success Logout');
        }

        return $this->returnFalse('Unauthorised');
    }
}