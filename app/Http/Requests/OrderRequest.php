<?php

namespace App\Http\Requests;

use App\Models\WorkShift;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'work_shift_id' => [
                'required', 
                'numeric', 
                'exists:work_shifts,id',
                function (string $attribute, mixed $value, \Closure $fail) {
                    $record = WorkShift::find($value);
                    if (!$record || !$record->active) {
                        $fail("Forbidden. The shift must be active!");
                    }
                }
            ],
            'table_id' => ['required', 'numeric', 'exists:tables,id'],
            'number_of_person' => ['numeric', 'sometimes']
        ];
    }
    
    public function messages() {
        return [
            'work_shift_id.exists' => "Такой смены не существует!",
            'table_id.exists' => "Такого столика не существует!"
        ];
    }
    
}
