<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required',
            'login' => 'required|unique:users,login',
            'password' => 'required|string|min:8|confirmed'
        ];
    }
    
    public function messages() {
        return  [
            'unique' => 'Такой логин уже существует!',
            'password.min' => "Пароль должен быть минимум 8 символов",
            'password.confirmed' => "Пароли должны совпадать"
        ];
    }
}
