<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WorkShiftUser extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'work_shift_id'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
    
    public function workShift() {
        return $this->belongsTo(WorkShift::class);
    }
}
