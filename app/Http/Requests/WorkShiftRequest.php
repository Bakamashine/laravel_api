<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkShiftRequest extends FormRequest
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
            "start" => "required|date_format:Y-m-d H:i",
            "end" => "required|date_format:Y-m-d H:i",
        ];
    }

    public function messages()
    {
        return [
            "date_format" => "Поле :attribute должно быть по формату Y-m-d H:i"
        ];
    }
}
