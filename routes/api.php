<?php

use App\Http\Controllers\Api\v1\Quiz\QuizGameController;
use App\Http\Controllers\Api\v1\Setting\SettingController;
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

        //Avatar
        Route::get('avatar', [QuizGameController::class, 'index']);
        // Game Controller
        Route::get('global-settings', [SettingController::class, 'index']);
        /*Route::get('prizes', [GameController::class, 'prizes']);
        Route::get('schedules', [GameController::class, 'schedules']);
        Route::get('news', [GameController::class, 'news']);
        Route::get('documents', [GameController::class, 'documents']);
        Route::post('save-attempt-game', [GameController::class, 'saveAttemptGame']);
        Route::post('game-result', [GameController::class, 'gameResult']);
        */

        // Question
        Route::get('question-game/{category}', [QuizGameController::class, 'index']);
 /*

        // Leader board
        Route::get('leaderboard', [LeaderBoardController::class, 'leaderBoard']);

        // Collection
        Route::get('detail-collection', [CollectionController::class, 'detailCollection']);
        Route::post('save-collection', [CollectionController::class, 'saveCollection']);
        Route::get('get-all-collection', [CollectionController::class, 'getAllCollection']);

        // Challenge
        Route::get('search-challengers/{search}', [ChallengeController::class, 'searchChallengers']);
        Route::post('claim-challenge', [ChallengeController::class, 'claimChallenge']);
        Route::post('save-challenge', [ChallengeController::class, 'saveChallenge']);
        Route::put('accept-challenge', [ChallengeController::class, 'acceptChallenge']);
        Route::get('challenge-data-game', [ChallengeController::class, 'challengeDataGame']);
*/
        // User
        Route::get('profile', [UserController::class, 'profile']);
      /*  Route::get('user-prizes', [UserController::class, 'userPrizes']); */
        Route::put('update-profile', [UserController::class, 'updateProfile']);
/*        Route::get('player-data', [UserController::class, 'playerData']);
        Route::get('player-data-game/{game_id}', [UserController::class, 'playerDataGame']);*/

        // Route::post('details', [UserController::class, 'details'])->name('details');
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });
});
