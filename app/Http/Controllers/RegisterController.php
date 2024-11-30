<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'username' => 'required|string|max:255'
        ]);
        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'user';
        $user->save();
        // Redirect về trang chủ hoặc trang danh sách sản phẩm
        return redirect()->route('login')->with('success', 'Product added successfully.');
    }
}
