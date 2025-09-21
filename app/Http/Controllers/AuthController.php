<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max:255',
            'email' => 'required | email | unique:users',
            'password'=> 'required | string | min:6 | confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'Register Successfully',
            'user' => $user,
        ],201);
    }

    //Login
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required | email',
            'password'=>'required | string'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password))
        {
            throw ValidationException::withMessages([
                'message'=>['Invalid Email or Password'],
            ]);
        } 
            $tokens = $user->createToken('Auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'access_tokem'=>$tokens,
                'token_type' => 'bearer',
                'user' =>$user,
            ],200);
        
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout successfully'
        ],200);
    }


}
