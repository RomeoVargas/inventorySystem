<?php

namespace App\Http\Middleware;

use App\Services\Session;
use Closure;
use Illuminate\Support\Facades\Auth;

class LoginRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (explode('/', get_route_name())[0] == 'admin') {
            if (!Session::get('admin')) {
                return redirect('admin/login')->with([
                    'loginError' => 'You must be logged in to continue'
                ]);
            }
        } else {
            if (!Auth::user()) {
                return redirect('home')->with([
                    'loginError' => 'You must be logged in to continue'
                ]);
            }
        }

        return $next($request);
    }
}
