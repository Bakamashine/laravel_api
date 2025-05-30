<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkShiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "start" => $this->start,
            "end" => $this->end,
            "active" => $this->active,
            "orders" => $this->orders,
            // "amount_for_all" => $this->orders->position->sum("price") | null
        ];
    }
}
