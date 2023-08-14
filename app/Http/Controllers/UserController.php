<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login as an admin user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", example="password"),
     *             @OA\Property(property="remember", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful login"),
     *     @OA\Response(response=403, description="Email or password is incorrect or user is not an admin")
     * )
     */
    public function login(LoginRequest $request)
    {
        $data=$request->validated();
        $remember=$data['remember']??false;
        unset($data['remember']);
        if(!Auth::attempt($data,$remember)){
            return response([
                'message' => 'Email or password is incorrect'
            ],403);
        }


        /** @var User $user */
        $user=Auth::user();
        if(!$user->is_admin){
            Auth::logout();
            return response([
                'message' => 'you don\'t have permission to authenticate as admin'
            ],403);
        }

        $token=$user->createToken('main')->plainTextToken;
        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);


    }
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout the currently authenticated user",
     *     tags={"Authentication"},
     *     @OA\Response(response=204, description="Logout successful"),
     *     security={{ "bearerAuth":{} }}
     * )
     */

    public function logout(){
        /** @var User $user */
        $user=Auth::user();
        $user->currentAccessToken()->delete();
        return response('',204);
    }

    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Get the currently authenticated user's details",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     security={{ "bearerAuth":{} }}
     * )
     */
    public function user(Request $request){
        return new UserResource($request->user());
    }
}
