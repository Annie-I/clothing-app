<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsNotBlocked
{
    // Log user out if they are blocked
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->is_blocked) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('error', 'Jūsu kontam ir liegta turpmāka piekļuve sistēmai.');
        }

        return $next($request);
    }
}
