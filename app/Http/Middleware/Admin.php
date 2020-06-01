<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
        // hàm xử lý kiểm tra yêu cầu sau lệnh next kiểm tra xong sẽ được đi tiếp
    {
//        if(!Auth::check()){
//            return redirect()->to("login"); // kiểm tra nếu chưa đăng nhập thì sẽ redirect về trang login
//        }
        $currentUser = Auth::user(); // biến nãy sẽ là lấy user hiện tại đang đăng nhập
        if($currentUser->__get("role") != User::ADMIN_ROLE)
            return abort(404); // khong phai admin thi cho ra trang 404 la admin thì chạy sang next
        return $next($request);

    }
}
