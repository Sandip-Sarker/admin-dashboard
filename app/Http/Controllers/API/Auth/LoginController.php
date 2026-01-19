<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return $this->error('Invalid credentials', 401);
            }

            $user = Auth::user();

            // Token Create
            $token = $user->createToken('token')->plainTextToken;

            $data = [
                'token_type' => 'Bearer',
                'token' => $token,
                'remember_me' => $request->boolean('remember'),
                'user'        => $user,
            ];

            return $this->success('Login Successful', $data, 200);
        }catch (\Exception $e){
            return $this->error($e->getMessage(), 500);
        }
    }

}
