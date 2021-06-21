<?php

namespace App\Http\Controllers\ActivityLog;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;


class ActivityLogController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('activity-log.index');
    }
}