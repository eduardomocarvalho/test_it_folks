<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(UserRequest $request){

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'cpf'  => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return $user;
    }

    public function login(UserLoginRequest $request){

        $user = User::where(['email'=> $request['email']])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        Auth::login($user);
        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::user()?->tokens()->delete();

        return ['success' => true];
    }
}

