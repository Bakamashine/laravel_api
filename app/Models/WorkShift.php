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
 * @property string|null $users_id
 * @method static \Database\Factories\WorkShiftFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereUsersId($value)
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
}
