<?php

use App\Http\Controllers\Api\V1\MasterPlanController;
use App\Http\Controllers\Api\V1\PublicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/publications', [PublicationController::class, 'index']);
Route::get('/publication/{slug}', [PublicationController::class, 'show']);


Route::get('/master-plans', [MasterPlanController::class, 'index']);
Route::get('/master-plan/{slug}', [MasterPlanController::class, 'show']);
