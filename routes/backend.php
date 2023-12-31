<?php

use App\Http\Controllers\Admin\About\FaqController;
use App\Http\Controllers\Admin\About\FaqTypeController;
use App\Http\Controllers\Admin\About\MemberController;
use App\Http\Controllers\Admin\Activity\ActivityController;
use App\Http\Controllers\Admin\CustomTable\CustomTableController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Inquiry\InquiryController;
use App\Http\Controllers\Admin\MasterPlan\PlanController;
use App\Http\Controllers\Admin\MasterPlan\PlotController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MediaRoom\GalleryController;
use App\Http\Controllers\Admin\MediaRoom\PublicationController;
use App\Http\Controllers\Admin\PublicRegistry\PublicRegistryController;
use App\Http\Controllers\Admin\PublicRegistry\PublicRegistryTypeController;
use App\Http\Controllers\Admin\Regulation\RegulationController;
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
        Route::resource('publication', PublicationController::class)->except('show');

        Route::resource('gallery', GalleryController::class)->except('show');

    });

    Route::group(['prefix' => 'public-registry', 'as' => 'public-registry.'], function () {
        //Route::resource('category', MediaRoomCategoryController::class)->except('show', 'destroy');
        Route::resource('type', PublicRegistryTypeController::class)->except('show');

        Route::resource('public-registry', PublicRegistryController::class)->except('show');
    });

    Route::resource('activity', ActivityController::class)->except('show');

    Route::resource('rules-and-regualtion', RegulationController::class, ['names' => 'regulation'])->except('show');

    Route::group(['prefix' => 'about', 'as' => 'about.'], function () {

        Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {

            Route::resource('type', FaqTypeController::class)->except('show');
            Route::resource('faq', FaqController::class)->except('show');
        });


        Route::resource('member', MemberController::class)->except('show');

    });

    Route::group(['prefix' => 'master-plan', 'as' => 'master-plan.'], function () {

        Route::resource('plan', PlanController::class)->except('show');
        Route::resource('plot', PlotController::class)->except('show');

    });

    Route::resource('custom-table', CustomTableController::class)->except('show');

    Route::resource('event', EventController::class)->except('show');

    Route::resource('inquiry', InquiryController::class)->only('index', 'show');

    Route::delete('/media/delete/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
});
