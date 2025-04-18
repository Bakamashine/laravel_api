<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Http\Request;
use App\Models\WorkShift;
use Validator;
use Illuminate\Validation\ValidationException;

class WorkShiftController extends Controller
{

    use \App\ApiHelper;

    protected $rules = [
        "start" => "required|date_format:Y-m-d H:i",
        "end" => "required|date_format:Y-m-d H:i",
    ];

    protected $message = [
        "date_format" => "Поле :attribute должно быть по формату Y-m-d H:i"
    ];
    public function create(Request $request)
    {

        try {
            Validator::make($request->all(), $this->rules, $this->message)->validate();
            $work_shift = WorkShift::create([
                "start" => $request->start,
                "end" => $request->end
            ]);
            return response()->json([
                "id" => $work_shift->id,
                "start" => $work_shift->start,
                "end" => $work_shift->end
            ], 201);
        } catch (ValidationException $e) {
            return $this->ValidateError($e->validator->errors()->all());
        }
    }

    public function open(WorkShift $id)
    {
        $active = 1;

        $check = WorkShift::where('active', '=', 1)->exists();
        if ($check) {
            $code = 403;
            return $this->codeAndMessage('Forbidden. There are open shifts!', $code);
        }
        $id->update(['active' => $active]);

        return $this->OutputWorkShift($id);
    }

    protected function OutputWorkShift($id)
    {
        return $this->data([
            "id" => $id->id,
            "start" => $id->start,
            "end" => $id->end,
            "active" => $id->active ? true : false
        ]);
    }
    public function close(WorkShift $id)
    {
        $close = 0;
        if ($id->active == 0) {
            return $this->codeAndMessage("Forbidden. The shift is already closed!", 403);
        }
        $id->update(['active' => $close]);
        return $this->OutputWorkShift($id);

    }

    public function addUser(Request $request, WorkShift $id)
    {
        try {
            Validator::make($request->all(), ['user_id' => "required|numeric"])->validate();
            echo "Пока в разработке";
        } catch (ValidationException $e) {
            return $this->ValidateError($e->validator->errors()->all());
        }
    }
}
