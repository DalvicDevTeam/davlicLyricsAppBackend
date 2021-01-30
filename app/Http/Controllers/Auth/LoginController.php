<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        //validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);



        //sign the user
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['msg' => 'Invalid credentials'], 401);
        }



        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json(['status_code'=>400,'response'=>$response]);




    }

}