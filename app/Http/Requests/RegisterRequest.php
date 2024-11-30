<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bạn có thể thực hiện xác thực người dùng ở đây nếu cần
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'The passwords do not match.',
        ];
    }
}
