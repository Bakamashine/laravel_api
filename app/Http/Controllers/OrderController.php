<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\WorkShiftUser;

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

        $user_id = \Auth::id();
        $record = WorkShiftuser::where("id", $request->work_shift_id)->where("user_id", $user_id)->first();
        if (!$record) {
            return $this->Forbidden("Forbidden. You don't work this shift!");
        }
    }
}
