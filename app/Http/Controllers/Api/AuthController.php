<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRequest $request): JsonResponse
    {
        try {
            $user = new User();
            $user = $user->createUser($request->name, $request->email, $request->password);
            return response()->json($user, 201);
        } catch (\Exeception $ex) {
            return response()->json('Something went wrong', 400);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            $user = new User();
            $user = $user->getUserByEmail($request->email);
            return response()->json($user, 201);

        } catch (\Exeception $ex) {
            return response()->json('Something went wrong', 400);
        }
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user(), 200);
    }


    public function logout(Request $request): JsonResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        auth('sanctum')->user()->tokens()->delete();
        return response()->json(['message' => "Logged Out Successfully"], 201);
    }


}
