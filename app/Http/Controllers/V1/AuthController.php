<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function login(LoginRequest $request)
    {
        
        if(!auth('web')->attempt($request->only('email','password')))
        {
            return response()->json([
                'message'=> "Invalid login creadientials"
            ],401);
        }

        $user = User::where(['email'=>$request->email])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'type' => 'Bearer'
        ],200);
    }

    public function profile(User $user)
    {
        
    }
}
