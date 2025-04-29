<?php

namespace App\Http\Controllers;

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
    public function __invoke(OrderRequest $request) {
        $validated = $request->validated();

        $user_id = auth('sanctum')->id();
        $record = WorkShiftuser::where("id", $request->work_shift_id)->where("user_id", $user_id)->first();
        if (!$record) {
            return $this->Forbidden("Forbidden. You don't work this shift!");
        }
        
        // TODO: После миграции, следует убрать status
        $order = Order::create([
            'count' => $request->count,
            'work_shift_users_id'  => $user_id,
            'table_id' => $request->table_id,
        ]);
        
        if ($order) {
            return $this->data([
                "id" => $order->id,
                "table" => $order->tables->name,
                "shift_workers" => auth('sanctum')->user()->name,
                'created_at' => $order->created_at,
                "status" => $order->status,
                "price" => $order->price
            ]);
        }
    }
}
