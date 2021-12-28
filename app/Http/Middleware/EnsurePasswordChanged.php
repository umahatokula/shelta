<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePasswordChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        if (!$user->password_change_date && $user->hasRole('staff')) {
            return redirect()->route('password.change');
        }
        
        if (!$user->password_change_date && $user->hasRole('client')) {
            return redirect()->route('frontend.password.change')->with('info', 'Change your password to proceed');
        }

        return $next($request);
    }
}
