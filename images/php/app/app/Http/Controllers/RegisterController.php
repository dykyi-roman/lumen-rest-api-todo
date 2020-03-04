<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ]);

        $generateRandomString = Str::random(60);
        $token = hash('sha256', $generateRandomString);

        $user = new Users();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->gender = $request->input('gender');
        $user->birthday = $request->input('birthday');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->api_token = $token;
        if ($user->save()) {
            return response()->json(['status' => 'success', 'user' => $user, 'token' => 'Bearer ' . $token], 201);
        }

        return response()->json(['status' => 'error', 'messages' => 'Bad request'], 400);
    }
}

