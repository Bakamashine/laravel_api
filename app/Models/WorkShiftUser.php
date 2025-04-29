<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WorkShiftUser extends Model
{
    public $timestamps = false;

    public function users() {
        return $this->belongsTo(User::class);
    }
}
