<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\WorkShiftUser;
use App\Models\Order;

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
        $record = WorkShiftuser::where("id", $request->work_shift_id)
            ->where("user_id", $user_id)
            ->first();
        if (!$record) {
            return $this->Forbidden("Forbidden. You don't work this shift!");
        }
        
        $order = Order::create([
            'count' => $request->count,
            'work_shift_user_id' => $user_id,
            'table_id' => $request->table_id,
        ]);

        if ($order) {
            return $this->data([
                "id" => $order->id,
                "table" => $order->table->name,
                "shift_workers" => auth('sanctum')->user()->name,
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
        if ($id->workshiftuser->users->id == auth('sanctum')->user()->id) {
            $res =  new OrderResource($id);
            return $res 
            ? $res
            : $this->NotFound();
        } else {
            return $this->Forbidden("Forbidden. You did not accept this order!");
        }
    }
}
