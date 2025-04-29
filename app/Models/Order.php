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
    
    public function workshiftuser() {
        return $this->belongsTo(WorkShiftUser::class, 'work_shift_user_id', 'id');
    }
    
    public function table() {
        return $this->belongsTo(Table::class);
    }
}
