<?php

use App\Http\Controllers\ActivityLog\ActivityLogController;
use App\Http\Controllers\Appreciation\AppreciationController;
use App\Http\Controllers\Assessment\AssessmentController;
use App\Http\Controllers\AssessmentCategory\AssessmentCategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ConfirmedEmailController;
use App\Http\Controllers\DailyAttempt\DailyAttemptController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderBoard\LeaderBoardController;
use App\Http\Controllers\Profile\UserController as ProfileUserController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\QuizGame\QuizGameController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Livewire\AcceptedInvitationComponent;
use App\Http\Livewire\CreateUserComponent;
use App\Http\Livewire\EditUserComponent;
use App\Http\Livewire\IndexUserComponent;

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');


Route::get('accepted-invitations/create', AcceptedInvitationComponent::class)
    ->name('accepted-invitations.create');

Route::get('confirmed-emails/store', [ConfirmedEmailController::class, 'store'])
    ->name('confirmed-emails.store');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');

    Route::group(
        ['prefix' => 'profile'],
        function () {
            Route::get('/', [ProfileUserController::class, 'index'])->name('profile.users.index');
        }
    );

    Route::middleware(['authorization'])->group(function () {
        Route::get('users', IndexUserComponent::class)->name('users.index');
        Route::get('users/create', CreateUserComponent::class)->name('users.create');
        Route::get('users/{user}/edit', EditUserComponent::class)->name('users.edit');

        Route::get('quiz-game/choices', [QuizGameController::class, 'choices'])->name('quiz-game.choices');
        Route::get('quiz-game/matches', [QuizGameController::class, 'matches'])->name('quiz-game.matches');
        Route::get('quiz-game/completes', [QuizGameController::class, 'completes'])->name('quiz-game.completes');

        Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('leaderboard', [LeaderBoardController::class, 'index'])->name('leaderboard.index');
        Route::get('department', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('assessment-question', [QuestionController::class, 'index'])->name('question.index');
        Route::get('assessment', [AssessmentController::class, 'index'])->name('assessment.index');
        Route::get('assessment-bulk-import', [AssessmentController::class, 'bulkImport'])->name('assessment.bulkImport');
        Route::get('assessment/download', [AssessmentController::class, 'export'])->name('assessment.export');
        Route::get('assessment/notFound', [AssessmentController::class, 'notFound'])->name('assessment.notFound');
        Route::get('appreciation', [AppreciationController::class, 'index'])->name('appreciation.index');
        Route::get('assessment-category', [AssessmentCategoryController::class, 'index'])->name('assessment-category.index');
//        Route::get('roles', IndexRoleComponent::class)->name('roles.index');
//        Route::get('roles/create', CreateRoleComponent::class)->name('roles.create');
//        Route::get('roles/{role}/edit', EditRoleComponent::class)->name('roles.edit');

        Route::get('daily-attempt', [DailyAttemptController::class, 'index']);
    });
});
