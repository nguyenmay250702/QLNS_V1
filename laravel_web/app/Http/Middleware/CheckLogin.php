<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        if (Auth::check()) { //kiểm tra xem người dùng đã đăng nhập hay chưa, nếu đăng nhập rồi thì next
            return $next($request);
        }
        return redirect()->route("login")->with("error", "Vui lòng nhập thông tin đăng nhập.");
    }

    
}
