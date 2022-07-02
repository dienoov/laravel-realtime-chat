<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token)
            return response([
                'message' => 'Unauthenticated',
            ], 401);

        $user = User::where('token', $token)->first();

        if (!$user)
            return response([
                'message' => 'Unauthenticated',
            ], 401);

        Auth::login($user);

        return $next($request);
    }
}
