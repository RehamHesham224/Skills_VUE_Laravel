<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    public function logout(){
        /** @var User $user */
        $user=Auth::user();
        $user->currentAccessToken()->delete();
        return response('',204);
    }

    public function user(Request $request){
        return new UserResource($request->user());
    }
}
