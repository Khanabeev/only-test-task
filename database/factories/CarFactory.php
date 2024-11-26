<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model'=> $this->faker->randomElement(['Honda', 'Volvo', 'BMW', 'Kia', 'Toyota', 'Mercedes-Benz']),
            'comfort_category_id' => ComfortCategory::query()->inRandomOrder()->first()->id,
            'driver_id' => Driver::query()->inRandomOrder()->first()->id,
        ];
    }
}
