<?php

namespace App\Http\Requests;

use App\Models\WorkShift;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class OrderRequest extends FormRequest
{
    
    use \App\ApiHelper {
        data as new_data;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    public function data($data = null, $default = null) {
        return parent::data($data, $default);
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
            'number_of_person' => ['numeric', 'sometimes'],
            'status' => ['sometimes']
        ];
    }

    public function messages()
    {
        return [
            'work_shift_id.exists' => "Такой смены не существует!",
            'table_id.exists' => "Такого столика не существует!"
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        if ($errors->has('work_shift_id') && $errors->first('work_shift_id') === "Forbidden. The shift must be active!") {
            throw new HttpResponseException(
                $this->Forbidden(
                    $errors->first("work_shift_id")
                )
            );
        }
        throw new HttpResponseException($this->ValidateError($errors));
    }
}
