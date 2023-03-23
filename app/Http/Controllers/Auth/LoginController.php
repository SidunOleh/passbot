<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (! Auth::attempt($credentials)) {
            return response([
                'error' => 'Login or password is wrong',
            ], 422);
        }

        return response([
            'message' => 'Ok',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response([
            'message' => 'Ok',
        ]);
    }
}
