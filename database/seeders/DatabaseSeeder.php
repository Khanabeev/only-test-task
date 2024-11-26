<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ComfortCategory;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::factory()->count(10)->create();
        ComfortCategory::factory()->count(3)->create();
        Driver::factory()->count(5)->create();
        Car::factory()->count(10)->create();

        $employees = Employee::all();
        $categories = ComfortCategory::all();

        foreach ($employees as $employee) {
            $employee->comfortCategories()->attach($categories->random(rand(1, 2))->pluck('id'));
        }

        Trip::factory()->count(5)->create();
    }
}
