<?php

namespace App\Http\Controllers\Api\v1\Setting;

use App\Http\Controllers\Api\BaseController;

use App\Http\Resources\Setting\GlobalSettingsCollection;
use App\Http\Resources\Setting\UserQuizDataResource;
use App\Models\DailyAttempt;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingController extends BaseController
{
    public function index()
    {
        $settings = Setting::all();

        if ($settings) {
            return new GlobalSettingsCollection($settings);
        } else {
            return $this->returnFalse();
        }
    }

    public function userQuizData()
    {
        $userDailyAttemps = DailyAttempt::where('user_id', me()->id)
            ->whereDate('date', Carbon::today())
            ->get();

        if ($userDailyAttemps) {
            return new UserQuizDataResource($userDailyAttemps);
        } else {
            return $this->returnFalse();
        }

    }
}