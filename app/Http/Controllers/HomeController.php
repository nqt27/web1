<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {

        return view('home');
    }
    public function checkDomain(Request $request)
    {
        $domain = $request->input('domain');
        $apiKey = 'at_uLzTPJAKEwctBDOG0nuRVWaGLxXpP'; // Thay bằng API key của bạn
        $response = Http::get("https://www.whoisxmlapi.com/whoisserver/WhoisService", [
            'domainName' => $domain,
            'apiKey' => $apiKey,
            'outputFormat' => 'json'
        ]);
        if (!$response->successful()) {
            return back()->with('error', 'Không thể kết nối tới dịch vụ kiểm tra tên miền.');
        }

        $data = $response->json();

        if (isset($data['WhoisRecord']['registryData']['domainName'])) {
            $status = "Tên miền $domain đã tồn tại.";
        } else {
            $status = "Tên miền $domain chưa được đăng ký.";
        }
        return redirect()->route('home')->with([
            'domain' => $domain,
            'status' => $status,
            'details' => $data['WhoisRecord']['registryData'] ?? null
        ]);
    }
}
