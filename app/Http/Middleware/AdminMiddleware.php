<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Kiểm tra nếu người dùng đã đăng nhập VÀ có quyền admin thì mới cho đi tiếp
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Nếu không phải admin, đá bay ra trang chủ kèm thông báo lỗi
    return redirect('/')->with('error', 'Bạn không có quyền truy cập vào khu vực Quản trị!');
}
}