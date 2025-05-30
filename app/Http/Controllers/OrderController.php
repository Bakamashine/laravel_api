<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use App\Models\WorkShiftUser;
use App\Models\Order;
use App\Models\WorkShift;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

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

        try {
            $record = WorkShiftuser::where('work_shift_id', $request->work_shift_id)
                ->where('user_id', $user_id)->firstOrFail();


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
        } catch (ModelNotFoundException $e) {
            return $this->Forbidden("Forbidden. You don't work this shift!");
        }
    }

    /**
     * Получение заказа по id
     * @param \App\Models\Order $order
     * @return mixed|OrderResource|\Illuminate\Http\JsonResponse
     */
    public function getForId(Order $order)
    {
        if ($order->workshiftuser->user_id == auth('sanctum')->user()->id) {
            if ($order->workshiftuser->workShift->active == "0") {
                return $this->Forbidden("Forbidden. The shift must be active!");
            }
            $res = new OrderResource($order);
            return $res
                ? $res
                : $this->NotFound();
        } else {
            return $this->Forbidden("Forbidden. You did not accept this order!");
        }
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            "status" => ['required', 'string']
        ]);


        if (
            $order->workshiftuser->user_id != auth('sanctum')->user()->id
            &&
            auth('sanctum')->user()->role_id != 3
        ) {
            return $this->Forbidden("Forbidden! You did not accept this order!");
        }

        if ($order->work_shift->active == 0) {
            return $this->Forbidden("You cannot change the order status of a closed shift!");
        }

        $order->update(['status' => $request->status]);
        return $this->data([
            "id" => $order->id,
            "status" => $request->status
        ], 200);
    }

    public function get_All_With_Good_Status()
    {
        $order = Order::where('status', "Принят")->orWhere("status", 'Готовится')->get();
        return new OrderCollection($order);
    }
}
