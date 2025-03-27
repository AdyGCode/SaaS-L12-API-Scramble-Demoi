<?php

use App\Http\Controllers\Api\v1\AuthController as AuthControllerV1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * API Version 1 Routes
 */

    /**
     * User API Routes
     * - Register, Login (no authentication)
     * - Profile, Logout (authentication required)
     */
    Route::post('register', [AuthControllerV1::class, 'register']);
    Route::post('login', [AuthControllerV1::class, 'login']);

    Route::get('profile', [AuthControllerV1::class, 'profile'])->middleware(['auth:sanctum',]);
    Route::post('logout', [AuthControllerV1::class, 'logout'])->middleware(['auth:sanctum',]);

    Route::get('user', static function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    /**
     * Other V1 Feature Routes
     * (Add a heading before each feature's set of routes)
     */


