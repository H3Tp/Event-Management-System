<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next, string $panel): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($panel === 'organizer' && $user->email === 'organizer@gmail.com') {
                return $next($request);
            }
            if ($panel === 'organizer1' && $user->email === 'organizer1@gmail.com') {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Unauthorized access.');
    }
}