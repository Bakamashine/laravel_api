<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use App\Models\WorkShiftUser;
use App\Models\Order;
use App\Models\WorkShift;

class OrderController extends Controller
{
    use \App\ApiHelper;
    /**
     * Добавление нового заказа
     * @param \App\Http\Requests\OrderRequest $request
     * @return void
     */
    public function __invoke(OrderRequest $request)
    {
        $request->validated();

        $user_id = auth('sanctum')->id();

        $record = WorkShiftUser::find($request->work_shift_id)
            ->where("user_id", $user_id)
            ->first();
        if (!$record) {
            return $this->Forbidden("Forbidden. You don't work this shift!");
        }

        $workshift = WorkShift::find($request->work_shift_id);

        $order = $workshift->orders()->create([
            'count' => $request->count,
            'work_shift_user_id' => $record->id,
            'table_id' => $request->table_id,
        ]);

        if ($order) {
            return $this->data([
                "id" => $order->id,
                "table" => $order->table->name,
                "shift_workers" => $order->workshiftuser->user->name,
                'created_at' => $order->created_at,
                "status" => "Принят",
                "price" => 0
            ]);
        }
    }

    /**
     * Получение заказа по id
     * @param \App\Models\Order $id
     * @return mixed|OrderResource|\Illuminate\Http\JsonResponse
     */
    public function getForId(Order $id)
    {
        if ($id->workshiftuser->user_id == auth('sanctum')->user()->id) {
            if ($id->workshiftuser->workShift->active == "0") {
                return $this->Forbidden("Forbidden. The shift must be active!");
            }
            $res = new OrderResource($id);
            return $res
                ? $res
                : $this->NotFound();
        } else {
            return $this->Forbidden("Forbidden. You did not accept this order!");
        }
    }
}
