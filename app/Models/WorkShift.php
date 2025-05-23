<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $start
 * @property string $end
 * @property int $active
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkShiftUser> $workshiftuser
 * @property-read int|null $workshiftuser_count
 * @method static \Database\Factories\WorkShiftFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereStart($value)
 * @mixin \Eloquent
 */
class WorkShift extends Model
{
    /** @use HasFactory<\Database\Factories\WorkShiftFactory> */
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        "start",
        "end",
        "active"
    ];
    
    public function workshiftuser() {
        return $this->hasMany(WorkShiftUser::class);
    }
    
    public function orders() {
        return $this->morphMany(Order::class, "work_shift");
    }
}
