<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersControllers extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('name', $username)->first();
        if (!$user || !Hash::check($password, $password ? $user->password : '')) {
            return response()->json([
                'message' => 'Invalid username or password!'
            ], 401);
        }

        // revoke old tokens
        $user->tokens()->delete();
        $user->token = $user->createToken('access')->plainTextToken;

        return response()->json([
            'user' => $user
        ]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ]);
    }
}
