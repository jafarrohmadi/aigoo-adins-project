<?php

use App\Http\Controllers\Api\v1\Appreciation\AppreciationController;
use App\Http\Controllers\Api\v1\Assessment\AssessmentController;
use App\Http\Controllers\Api\v1\Avatar\AvatarController;
use App\Http\Controllers\Api\v1\Category\CategoryController;
use App\Http\Controllers\Api\v1\DailyAttempt\DailyAttemptController;
use App\Http\Controllers\Api\v1\Department\DepartmentController;
use App\Http\Controllers\Api\v1\Guild\GuildController;
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


Route::get('update-all-user', [UserController::class, 'addAllUser']);
Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('profile', [UserController::class, 'profile']);
        Route::post('update-profile', [UserController::class, 'updateProfile']);
        Route::get('get-user', [UserController::class, 'getAllUser']);
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
        Route::get('user-data', [UserController::class, 'getUserData']);
    });
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('global-settings', [SettingController::class, 'index']);
    Route::get('user-quiz-data', [SettingController::class, 'userQuizData']);
    Route::get('quiz-game/{category}', [QuizGameController::class, 'index']);
    Route::post('quiz-game',[QuizGameController::class, 'store']);
    //Avatar
    Route::get('avatar', [AvatarController::class, 'index']);
    Route::post('avatar', [AvatarController::class, 'storeOrUpdate']);
    Route::post('buy-new-avatar', [AvatarController::class, 'buyNewAvatar']);
    //Team
    Route::post('team', [TeamController::class, 'update']);

    //Assessment
    Route::get('assessment', [AssessmentController::class, 'index']);
    Route::post('assessment', [AssessmentController::class, 'store']);
    Route::get('get-assessment-user', [AssessmentController::class, 'getAssessmentUser']);

    //Appreciation
    Route::get('appreciation' , [AppreciationController::class, 'index']);
    Route::post('appreciation' , [AppreciationController::class, 'store']);

    //guild
    Route::get('guild' , [GuildController::class, 'index']);
    Route::post('guild/{id}' , [GuildController::class, 'update']);

    //LeaderBoard
    Route::get('leaderboard', [LeaderBoardController::class, 'index']);
    Route::get('leaderboard-data', [LeaderBoardController::class, 'leaderBoardData']);

    //User Collection
    Route::post('user-collection', [UserCollectionController::class, 'update']);

    //Save Daily Attempt
    Route::post('daily-attempt', [DailyAttemptController::class, 'store']);

    //Department
    Route::get('department', [DepartmentController::class, 'index']);

    //Category
    Route::get('category', [CategoryController::class, 'index']);
});

