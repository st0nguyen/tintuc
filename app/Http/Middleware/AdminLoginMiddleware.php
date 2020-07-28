<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
        if(Auth::check())
        {
            if(Auth::user()->quyen == 1)
                return $next($request);
            else
                return redirect('admin/dangnhap')->with('message','Tài khoản này không được phép truy cập!');
        }
        else
            return redirect('admin/dangnnhap')->with('message','Bạn chưa đăng nhập!');
    }
}
