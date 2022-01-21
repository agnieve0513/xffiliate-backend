<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // validate
        $request->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email|unique:users",
            "username" => "required",
            "role" => "required",
            "password" => "required|confirmed",
        ]);

        // create user data + save
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);

        $user->save();

        // send response
        return response()->json([
            "status" => 1,
            "message"=> "User registered successfully",
        ], 200);
    }

    public function login(Request $request)
    {
        // validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // verify user + token
        if(! $token = auth()->attempt(["email" => $request->email, "password" => $request->password]))
        {
            return response()->json([
                "status" => 0,
                "message" => "Invalid Credentials"
            ], 404);
        }


        // send response
        return response()->json([
            "status" => 1,
            "message" => "Logged in successfully",
            "data" => array(
                "userInfo" => auth()->user(),
                "access_token" => $token
            )
        ]);
    }

    public function profile()
    {
        $profile = User::select('users.id','firstname','lastname','email','role')
        ->where("users.id", auth()->user()->id)->first();

        return response()->json([
            "status" => 1,
            "message" => "Profile Found",
            "data" => $profile
        ], 200);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            "status"=> 1,
            "message"=> "User logged out"
        ]);
    }
}
