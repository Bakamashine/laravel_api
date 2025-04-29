<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkShift;

class WorkShiftSeeder extends Seeder
{

    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            WorkShift::create(['start' => '2021-03-26 08:00', 'end' => '2021-03-26 17:00', 'active' => 1]);
        }
    }
}
