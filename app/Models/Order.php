<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $count
 * @property int $work_shift_user_id
 * @property int $table_id
 * @property string $status
 * @property int $price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Position> $position
 * @property-read int|null $position_count
 * @property-read \App\Models\Table $table
 * @property-read \App\Models\WorkShiftUser $workshiftuser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereWorkShiftUserId($value)
 * @mixin \Eloquent
 */
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
    
    public function position() {
        return $this->hasMany(Position::class);
    }
}
