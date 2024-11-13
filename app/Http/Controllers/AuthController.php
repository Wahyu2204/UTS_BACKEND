<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($input);

        $data = [
            'message' => 'User created successfully',
            'user' => $user
        ];

        return response()->json($data, 200);
    }

    public function login(Request $request) {
        
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // if (Auth::attempt($input)) {
            
        //     $token = Auth::user()->createToken('auth_Token');

        //     $data = [
        //        'message' => 'User logged in successfully',
        //         'token' => $token->plainTextToken
        //     ];

        //     return response()->json($data, 200);
        // } else {
            
        //     $data = [
              
        //         'message' => 'Username or password incorrect',
        //     ];

        //     return response()->json($data, 401);
        // }

        $user = User::where('email', $input['email'])->first();

        $isLoginSeccessfully = (
            
            $input['email'] == $user->email
            &&
            Hash::check($input['password'], $user->password)
        );

        if ($isLoginSeccessfully) {
            
            $token = $user->createToken('auth_Token');

            $data = [
               'message' => 'Login Berhasil',
                'token' => $token->plainTextToken
            ];

            return response()->json($data, 200);
        } else {
            
            $data = [
              
                'message' => 'email atau password salah',
            ];

            return response()->json($data, 401);
        }
    }
}