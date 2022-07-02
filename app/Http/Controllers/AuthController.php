<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        $input = \request(['name', 'email']);
        $input['password'] = bcrypt($request->password);
        $input['token'] = Str::random();

        $user = User::create($input);

        Auth::login($user);

        return response([
            'message' => 'Success',
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $input = \request(['email', 'password']);

        if (!Auth::attempt($input))
            return response([
                'message' => 'Invalid credentials',
            ], 401);

        $user = Auth::user();

        $user['token'] = Str::random();;
        $user->save();

        return response([
            'message' => 'Success',
            'user' => $user,
        ]);
    }
}
