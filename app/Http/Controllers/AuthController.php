<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {

            $response = [
                'message' => 'Incorrect Credentials'
            ];

        } else {
            // Token generado por el método createToken de Laravel Sanctum
            $token = $user->createToken($fields['email'])->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
        }
        return response($response, 200);
    }

    public function logout(Response $response) {
        $user = User::find(auth()->user()->id);
        $user->tokens()->delete();
        // $x = auth()->user()->tokens()->delete();
        $response = [
            'message' => 'Close Session'
        ];
        return response($response, 200);
    }

}
