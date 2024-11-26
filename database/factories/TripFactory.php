<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::query()->inRandomOrder()->first()->id,
            'car_id' => Car::query()->inRandomOrder()->first()->id,
            'start_time' => $this->faker->dateTimeBetween('now', '+1 days'),
            'end_time' => $this->faker->dateTimeBetween('+2 days', '+3 days'),
        ];
    }
}
