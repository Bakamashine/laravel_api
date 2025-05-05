<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property int $count
 * @property int $price
 * @property string $position
 * @property-read \App\Models\Order|null $orders
 * @method static \Database\Factories\PositionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePrice($value)
 * @mixin \Eloquent
 */
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
