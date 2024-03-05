<?php

namespace App\Http\Controllers;

use App\Business\AbilitiesResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $abilities = AbilitiesResolver::resolve($user, $request->device);
            $token = $user->createToken('authToken', $abilities);
            return response()->json(['token' => $token], 200);
        }
        return response()->json(['error' => 'UnAuthorised'], 401);
    }
}
