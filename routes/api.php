<?php

use App\Classes\ApiResponse;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('categories', CategoryController::class);
});

/*
Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('categories', CategoryController::class)
        ->except(['update','delete',]);

    Route::apiResource('categories', CategoryController::class)
        ->only(['update','delete',])
        ->middleware('auth:sanctum');
});
*/

/**
 * Fallback to 404
 */
Route::fallback(static function () {
    return ApiResponse::error(
        [],
        "Page Not Found. If error persists, contact info@website.com",
        404
    );
});
