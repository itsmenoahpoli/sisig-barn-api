<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json('Unauthorized', 401);
        }

        $accessToken = Auth::user()->createToken(time().'sbcsauttoken')->plainTextToken;

        return response()->json([
            'user' => Auth::user(),
            'accessToken' => $accessToken,
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
    }
}
