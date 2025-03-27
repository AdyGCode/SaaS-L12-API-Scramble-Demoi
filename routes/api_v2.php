<?php
/**
 * API Version 2 Routes
 */

use App\Http\Controllers\Api\v2\AuthController as AuthControllerV2;
use App\Http\Controllers\Api\v2\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * User API Routes
 * - Register, Login (no authentication)
 * - Profile, Logout (authentication required)
 */

Route::post('register', [AuthControllerV2::class, 'register']);
Route::post('login', [AuthControllerV2::class, 'login']);

Route::get('profile', [AuthControllerV2::class, 'profile'])->middleware('auth:sanctum');
Route::post('logout', [AuthControllerV2::class, 'logout'])->middleware('auth:sanctum');

Route::get('user', static function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/**
 * Categories API Routes
 */
Route::apiResource('categories', CategoryController::class)
    ->only(['index', 'show',]);

Route::apiResource('categories', CategoryController::class)
    ->middleware('auth:sanctum')
    ->only(['store', 'update', 'destroy',]);

/**
 * Other V2 API Feature Routes
 * (Add a heading before each feature's set of routes)
 */
