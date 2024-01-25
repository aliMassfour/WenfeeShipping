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

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="loginUser",
     *     tags={"Authentication"},
     *     summary="Login user",
     *     description="Logs in a user with the provided email and password.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"email", "password"},
     *                 @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="password123")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", format="email", example="user@example.com")
     *             ),
     *             @OA\Property(property="token", type="string", description="Access token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     )
     * )
     */

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
    /**
     * @OA\Post(
     *     path="/logout",
     *     operationId="logoutUser",
     *     tags={"Authentication"},
     *     summary="Logout user",
     *     description="Logs out the authenticated user and revokes all access tokens.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User logout successfully")
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function logout(Request $request)
    {
        \auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "user logout successfully"
        ]);
    }
}
