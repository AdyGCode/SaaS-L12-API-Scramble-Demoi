<?php

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('categories', CategoryController::class);
//        ->only(['index', 'show', 'store',]);

//    Route::apiResource('categories', CategoryController::class)
//        ->only(['update','delete',])
//        ->middleware('auth:sanctum');
});
