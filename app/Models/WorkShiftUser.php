<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $work_shift_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\User|null $users
 * @property-read \App\Models\WorkShift|null $workShift
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShiftUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShiftUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShiftUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShiftUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShiftUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShiftUser whereWorkShiftId($value)
 * @mixin \Eloquent
 */
class WorkShiftUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'work_shift_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function workShift()
    {
        return $this->belongsTo(WorkShift::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
