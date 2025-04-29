<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "count",
        "work_shift_users_id",
        "table_id",
        "status"
    ];

    protected $hidden = [
        "updated_at"
    ];
    
    public function workshiftusers() {
        return $this->belongsTo(WorkShiftUser::class);
    }
    
    public function table() {
        return $this->belongsTo(Table::class);
    }
}
