<?php

namespace App\Http\Requests;

class AdminRequest extends UserRequest
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
            'password' => 'required|string|min:8',
            'surname' => 'string|min:5',
            'patronymic' => "string|min:5",
            'photo_file' => "image|mimetypes:image/jpeg,image/png",
            "role_id" => "required|numeric"
        ];
    }
}
