<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class AuthSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login.show');
        }

        // Optionally bind user to request for convenience
        $request->setUserResolver(function () use ($request) {
            return User::find($request->session()->get('user_id'));
        });

        return $next($request);
    }
}
