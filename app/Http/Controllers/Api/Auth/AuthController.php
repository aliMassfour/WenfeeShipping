<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\LoginException;
use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum")->except("login");
    }

    public function login(loginRequest $request)
    {
        if (!Auth::attempt($request->only(["email", "password"]))) {
            throw LoginException::invalidCredentials();
        }
        $user = \App\Models\User::query()->where("email", $request->email)->first();
        $token = $user->createToken("Application Access Token:" . $user->email)->plainTextToken;
        return response()->json([
            "user" => $user,
            "token" => $token
        ]);

    }

    public function logout(Request $request)
    {
        \auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "user logout successfully"
        ]);
    }
}
