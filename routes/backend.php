<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MediaRoom\MediaRoomController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'permission'])->group(function () {
    //Route::resource('permissions', PermissionsController::class)->except('show');
    Route::resource('roles', RolesController::class)->except('show');
    Route::resource('users', UsersController::class)->except('show');
    Route::put('/users/{user}/send-email-verification-notification', [UsersController::class, 'sendEmailVerificationNotification'])->name('users.sendEmailVerificationNotification');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/change-password', [UsersController::class, 'showChangePasswordGet'])->name('change-password.edit');

    Route::post('/change-password', [UsersController::class, 'changePasswordPost'])->name('change-password.update');
});

Route::group(['prefix' => '/filemanager', 'middleware' => ['web', 'auth', 'verified', 'optimizeImages', 'permission']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['auth', 'verified', 'permission'])->group(function () {

    Route::group(['prefix' => 'media-room', 'as' => 'media-room.'], function () {
        //Route::resource('category', MediaRoomCategoryController::class)->except('show', 'destroy');
        Route::resource('publication', MediaRoomController::class)->except('show');
    });

    Route::delete('/media/delete/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
});
