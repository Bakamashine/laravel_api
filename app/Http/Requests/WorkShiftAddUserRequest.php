<?php

namespace App\Http\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class WorkShiftAddUserRequest extends WorkShiftRequest
{
    
    use \App\ApiHelper {
        data as new_data;
    }

    public function data($data = null, $default = null)
    {
        return parent::data($data, $default);
    }

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

        $id = $this->route('id');
        return [
            'user_id' => [
                'required',
                'numeric',
                Rule::unique('work_shift_users')->where(
                    function (Builder $query) use ($id) {
                        return $query->where("work_shift_id", $id);
                    }
                ),
            ],
        ];
    }

    public function messages()
    {
        return [
            'unique' => "Forbidden. The worker is already on shift!",
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();
        if (
            $errors->has('user_id')
            &&
            $errors->first('user_id') === "Forbidden. The worker is already on shift!"
        ) {
            throw new HttpResponseException(
                $this->Forbidden(
                    $errors->first("user_id")
                )
            );
        }

        return parent::failedValidation($validator);
    }
}
