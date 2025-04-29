<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable =[
        "count",
        "position",
        "price"
    ];
    
    protected $hidden = [
        "order_id"
    ];
    
    public function orders() {
        return $this->belongsTo(Order::class);
    }
}
