<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkShift>
 */
class WorkShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDay = $this->faker->numberBetween(1, 31);
        $start = Carbon::create(2021, $randomDay, $this->faker->numberBetween(8, 10), 0, 0);
        $end = $start->copy()->addHours(9);

        return [
            'start' => $start,
            "end" => $end,
            "active" => 1
        ];
    }
}
