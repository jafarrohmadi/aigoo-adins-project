<?php

namespace App\Http\Controllers\Api\v1\Setting;

use App\Http\Controllers\Api\BaseController;

use App\Http\Resources\Setting\GlobalSettingsCollection;
use App\Models\Setting;
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
}