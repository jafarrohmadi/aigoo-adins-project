<?php

use App\Http\Controllers\Api\v1\Assessment\AssessmentController;
use App\Http\Controllers\Api\v1\Avatar\AvatarController;
use App\Http\Controllers\Api\v1\DailyAttempt\DailyAttemptController;
use App\Http\Controllers\Api\v1\LeaderBoard\LeaderBoardController;
use App\Http\Controllers\Api\v1\Quiz\QuizGameController;
use App\Http\Controllers\Api\v1\Setting\SettingController;
use App\Http\Controllers\Api\v1\Team\TeamController;
use App\Http\Controllers\Api\v1\User\UserCollectionController;
use App\Http\Controllers\Api\v1\User\UserController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('profile', [UserController::class, 'profile']);
        Route::put('update-profile', [UserController::class, 'updateProfile']);
        Route::get('get-user', [UserController::class, 'getAllUser']);
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('global-settings', [SettingController::class, 'index']);
    Route::get('quiz-game/{category}', [QuizGameController::class, 'index']);

    //Avatar
    Route::get('avatar', [AvatarController::class, 'index']);
    Route::put('avatar', [AvatarController::class, 'storeOrUpdate']);

    //Team
    Route::put('team', [TeamController::class, 'update']);

    //Assessment
    Route::get('assessment', [AssessmentController::class, 'index']);
    Route::post('assessment', [AssessmentController::class, 'store']);

    //LeaderBoard
    Route::get('leaderboard', [LeaderBoardController::class, 'index']);

    //User Collection
    Route::put('user-collection', [UserCollectionController::class, 'update']);

    //Save Daily Attempt
    Route::post('daily-attempt', [DailyAttemptController::class, 'store']);
});

