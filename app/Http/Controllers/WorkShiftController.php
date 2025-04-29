<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkShift;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Models\WorkShiftUser;

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

    /**
     * Создание смены
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
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

    /**
     * Открытие смены
     * @param \App\Models\WorkShift $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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

    /**
     * Вывод данных смены по ID
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function OutputWorkShift($id)
    {
        return $this->data([
            "id" => $id->id,
            "start" => $id->start,
            "end" => $id->end,
            "active" => $id->active ? true : false
        ], 200);
    }

    /**
     * Закрытие смены
     * @param \App\Models\WorkShift $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function close(WorkShift $id)
    {
        $close = 0;
        if ($id->active == 0) {
            return $this->codeAndMessage("Forbidden. The shift is already closed!", 403);
        }
        $id->update(['active' => $close]);
        return $this->OutputWorkShift($id);

    }

    public function addUser(Request $request, $id)
    {
        try {
            Validator::make(
                $request->all(),
                ['user_id' => ['required', 'numeric', 'unique:work_shift_users,user_id,'. $request->user_id]],
                ['unique' => "Forbidden. The worker is already on shift!"]
            )
                ->validate();
            $work_shift = WorkShiftUser::create($request->only('user_id'));
            // $work_shift = new WorkShiftUser(['user_id' => $request->user_id]);
            return $this->data(
                [
                    "id_user" => $work_shift->user_id,
                    "status" => "added"
                ],
                200
            );

        } catch (ValidationException $e) {
            if ($e->validator->errors()->has('user_id')) {
                return $this->Forbidden($e->validator->errors()->first("user_id"));
            }
            return $this->ValidateError($e->validator->errors()->all());
        }
    }
}
