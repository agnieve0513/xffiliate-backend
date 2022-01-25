<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function addRole(Request $request)
    {
        $request->validate([
            "user_id" => "required|unique:role",
            "firstname" => "required",
            "lastname" => "required",
            "role" => "required",
        ]);

        // create user data + save
        $user = new Role();
        $user->user_id = $request->user_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;

        $user->save();

        // send response
        return response()->json([
            "status" => 1,
            "message" => "User Role registered successfully",
        ], 200);
    }
}
