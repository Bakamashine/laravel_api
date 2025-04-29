<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkShiftUser;

class WorkShiftUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkShiftUser::create(['user_id' => 2, 'work_shift_id' => 1]);
        WorkShiftUser::create(['user_id' => 3, 'work_shift_id' => 1]);
    }
}
