<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (Auth::guard('web')->check()) {
            return redirect('/userhome'); // Redirect to the user's dashboard if the user is logged in.
        }

        if (Auth::guard('webadmin')->check()) {
            return redirect('/home'); // Redirect to the admin's dashboard if the admin is logged in.
        }
            /*if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }*/

        return $next($request);
    }
}
