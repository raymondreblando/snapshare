<?php

use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CoverPhotoController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\FacebookSignInController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleSignInController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageFollowerController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PageSnapController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SaveSnapController;
use App\Http\Controllers\SnapController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/', 'login')->name('login.auth');
    });
    
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register');
        Route::post('/register', 'store')->name('register.store');
    });

    Route::controller(GoogleSignInController::class)->group(function () {
        Route::get('/auth/google/redirect', 'redirect')->name('google.redirect');
        Route::get('/auth/google/callback', 'callback');
    });

    Route::controller(FacebookSignInController::class)->group(function () {
        Route::get('/auth/facebook/redirect', 'redirect')->name('facebook.redirect');
        Route::get('/auth/facebook/callback', 'callback');
    });
});

Route::middleware(['auth', 'revalidate'])->group(function () {
    Route::controller(EmailVerifyController::class)->group(function () {
        Route::get('/email/verify', 'index')->name('verification-notice');
        Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');;
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot-password', 'index')->name('password.request');
    });

    Route::controller(FeedController::class)->group(function () {
        Route::get('/feed', 'index')->name('feed');
        Route::get('/trending', 'trending')->name('trending');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/peoples', 'index')->name('peoples');
        Route::get('/user/{user}', 'show')->name('people.show');
        Route::get('/peoples/popular', 'popular')->name('peoples.popular');
        Route::get('/my-profile', 'myProfile')->name('my-profile');
    });

    Route::controller(FollowerController::class)->group(function () {
        Route::get('/follow', 'index')->name('followers');
        Route::post('/follow', 'store');
        Route::delete('/follow/{id}', 'destroy');
    });

    Route::controller(ReactController::class)->group(function () {
        Route::post('/react', 'store');
        Route::delete('/react/{id}', 'destroy');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('/comment', 'store');
        Route::delete('/comment/{id}', 'destroy');
    });

    Route::controller(SaveSnapController::class)->group(function () {
        Route::get('/saves', 'index')->name('saves');
        Route::post('/save', 'store');
        Route::delete('/save/{id}', 'destroy');
    });

    Route::controller(PageFollowerController::class)->group(function () {
        Route::post('/follow/page', 'store');
        Route::delete('/follow/page/{id}', 'destroy');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/snap/{snap}/{notification_id}', 'snap')->name('notif.snap');
        Route::get('/snap/{user}/{notification_id}', 'followed')->name('notif.followed');
    });

    Route::controller(AccountSettingController::class)->group(function () {
        Route::get('/account/setting', 'index')->name('account.setting');
        Route::put('/account/{user}/edit', 'update')->name('account.update');
        Route::put('/account/{user}/status', 'changeAccountStatus')->name('account.change.status');
        Route::put('/account/{user}/change-password', 'changePassword')->name('account.change.password');
    });

    Route::resource('snap', SnapController::class);
    Route::resource('page', PagesController::class);
    
    Route::post('/avatar', AvatarController::class);
    Route::post('/cover-photo', CoverPhotoController::class);
    Route::get('/snap/page/{id}/create', PageSnapController::class)->name('snap.page');
    Route::get('/top/page', TopPageController::class)->name('page.top');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});