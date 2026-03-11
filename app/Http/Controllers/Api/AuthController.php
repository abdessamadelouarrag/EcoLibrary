<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller{

    public function signup(Request $request){

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'lecteur',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'massage' => 'signup goood!!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}