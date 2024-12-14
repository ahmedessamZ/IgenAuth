<?php

use App\Http\Controllers\Api\V1\Auth\AuthenticateController;
use App\Http\Controllers\Api\V1\Uploads\UploadController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1/uploads'], function() {
    Route::post("store", [UploadController::class,'store']);
});

Route::group(['prefix' => 'v1/auth', 'middleware' => ['throttle:5,1', CheckApiToken::class] ], function() {
    Route::post('check-user', [AuthenticateController::class, 'checkUser']);
    Route::post('send-otp', [AuthenticateController::class, 'sendOtp']);
    Route::post('verify-otp', [AuthenticateController::class, 'verifyOtp']);
    Route::post('login', [AuthenticateController::class, 'login']);
    Route::post('register', [AuthenticateController::class, 'register']);
});
