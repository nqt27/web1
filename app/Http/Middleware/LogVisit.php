<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next)
    {
        $currentUrl = $request->path();

        // Chỉ ghi lại các truy cập không phải file tĩnh hoặc tài nguyên bổ sung
        if (!$this->isStaticAsset($currentUrl)) {
            $today = now()->toDateString();
            $ip = $request->ip();

            // Kiểm tra nếu truy cập đã được ghi nhận trong ngày
            if (!session()->has('visited_' . $today)) {
                DB::table('visits')->insert([
                    'visited_at' => now(),
                    'ip_address' => $ip,
                    'url' => $currentUrl,
                    'user_agent' => $request->userAgent(),
                ]);

                session(['visited_' . $today => true]);
            }
        }

        return $next($request);
    }

    // Hàm kiểm tra file tĩnh
    protected function isStaticAsset($url)
    {
        $staticExtensions = ['.js', '.css', '.map', '.png', '.jpg', '.jpeg', '.gif', '.svg', '.woff', '.woff2', '.ttf', '.eot'];
        foreach ($staticExtensions as $extension) {
            if (str_ends_with($url, $extension)) {
                return true;
            }
        }
        return false;
    }
}
