<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\LocationController;
use App\Http\Controllers\API\User\LoginController;
use App\Http\Controllers\API\User\NotificationController;
use App\Http\Controllers\API\User\AvatarController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware'=>'auth:sanctum'] , function () {
    Route::get('notification/{id}', [NotificationController::class,'notification']);
    Route::post('uploadAvatar', [AvatarController::class,'uploadAvatar']);
});

Route::group( ['prefix' => 'v1'], function () {
    Route::get('divisions', [LocationController::class,'divisions']);
    Route::get('districts/{id?}', [LocationController::class,'districts']);
    Route::get('thanas/{id?}', [LocationController::class,'thanas']);
});


Route::post("/user/login",[LoginController::class,'index']);


