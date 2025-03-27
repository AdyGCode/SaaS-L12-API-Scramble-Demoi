<?php

namespace App\Http\Controllers\Api\v2;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\v2\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

/**
 * API Version 2 - AuthController
 */
class AuthController extends Controller
{

    /**
     * Register a User
     *
     * Provide registration capability to the site visitor.
     *
     * Registration requires:
     * - name
     * - valid email address
     * - password (Minimum 8 characters, including: Capital, Lower, Number and Symbol)
     *
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {

//        if ($validator->fails()) {
//            return ApiResponse::error(['error' => $validator->errors()],
//                'Registration details error', 401);
//        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('MyAppToken')->plainTextToken;

        return ApiResponse::success(['token' => $token, 'user' => $user,],
            'User registered successfully.');
    }

    /**
     * User Login
     *
     * Attempt to log the user in using email
     * and password based authentication.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return ApiResponse::error(['error' => $validator->errors()],
                'Invalid credentials', 401);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return ApiResponse::error([],
                'Invalid credentials', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('MyAppToken')->plainTextToken;

        return ApiResponse::success(['token' => $token, 'user' => $user,],
            'Login successful.');
    }

    /**
     * User Profile API
     *
     * Provide the user's profile information, including:
     * - name,
     * - email,
     * - email verified,
     * - created at, and
     * - updated at.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        return ApiResponse::success(['user' => $request->user(),],
            'User profile request successful.');
    }

    /**
     * User Logout
     *
     * Log user out of system, cleaning token and session details.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return ApiResponse::success([], 'Logout successful.');
    }
}
