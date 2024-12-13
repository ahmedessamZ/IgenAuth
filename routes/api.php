<?php

use App\Http\Controllers\Api\V1\Uploads\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1/uploads'], function() {
    Route::post("store", [UploadController::class,'store']);
});
