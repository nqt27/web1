<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter; // Sử dụng RateLimiter
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validate dữ liệu nhập
        $request->validate([
            'username' => 'required', // Bắt buộc username
            'password' => 'required', // Bắt buộc mật khẩu
        ]);

        // 2. Lấy thông tin người dùng nhập
        $credentials = $request->only('username', 'password');

        // 3. Kiểm tra số lần nhập sai (Rate Limiting)
        if ($this->hasTooManyLoginAttempts($request)) {
            $lockoutTime = RateLimiter::availableIn($this->throttleKey($request)); // Lấy thời gian còn lại

            // Truyền số lần còn lại và thời gian khóa vào session hoặc với view
            return back()->with('error', 'Quá nhiều lần thử.')
            ->with('lockout_time', $lockoutTime);
        }

        // 4. Kiểm tra đăng nhập
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công -> Xóa số lần nhập sai
            $this->clearLoginAttempts($request);
            return redirect()->intended('admin') // Chuyển hướng sau khi đăng nhập
                ->with('success', 'Đăng nhập thành công!');
        } else {
            // 5. Đăng nhập thất bại -> Tăng số lần nhập sai
            $this->incrementLoginAttempts($request);
            $remainingAttempts = RateLimiter::retriesLeft($this->throttleKey($request), 5);  // Cập nhật số lần thử còn lại

            // Thêm thông báo lỗi vào session và thông báo số lần còn lại
            return back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu. Bạn còn ' . $remainingAttempts . ' lần thử');
        }
    }

    /**
     * Đăng xuất.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Bạn đã đăng xuất thành công!');
    }

    /**
     * Kiểm tra nếu nhập sai quá nhiều lần.
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts($this->throttleKey($request), 5); // 5 lần thử trong 1 phút
    }

    /**
     * Tăng số lần nhập sai.
     */
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), 15); // Reset sau 60 giây
    }

    /**
     * Xóa số lần nhập sai.
     */
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * Lấy khóa cho Rate Limiting.
     */
    protected function throttleKey(Request $request)
    {
        // Chỉ sử dụng địa chỉ IP làm khóa
        return $request->ip();
    }

    public function forgot()
    {
        return view('auth.forgot-password');
    }
}
