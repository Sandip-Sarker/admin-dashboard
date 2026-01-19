<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiResponse;
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);

            $user           = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = $request->password;
            $user->save();

            return $this->success('Registration Successfully',$user);
        }catch (\Exception $e){
            return $this->error($e->getMessage(), 500);
        }
    }

}
