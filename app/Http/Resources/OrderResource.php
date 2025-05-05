<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "table" => $this->table->name,
            "shift_workers" => $this->workshiftuser->users->name,
            "created_at" => $this->created_at,
            "status" => $this->status,
            "positions" => $this->position
        ];
    }
}
