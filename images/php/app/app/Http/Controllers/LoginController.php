<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        $user = Users::where('email', $request->input('email'))->first();
        if (null === $user) {
            return response()->json(['status' => 'error', 'message' => 'user not found'], 401);
        }

        if (Hash::check($request->input('password'), $user->password)) {
            $apiKey = base64_encode(Str::random(40));
            Users::where('email', $request->input('email'))->update(['api_token' => $apiKey]);
            $token = '' === $user->api_token ? $apiKey : $user->api_token;

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => 'Bearer ' . $token
            ], 200);
        }

        return response()->json(['status' => 'error'], 401);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = Users::where('email', $request->input('email'))->first();
        if (null === $user) {
            return response()->json(['status' => 'error', 'message' => 'user not found'], 400);
        }

        Users::where('email', $request->input('email'))->update(['api_token' => '']);

        return response()->json(['success' => true], 200);
    }
}
