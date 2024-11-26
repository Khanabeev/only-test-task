<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\ComfortCategory;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvailableCarsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Заполнение базы данных
        $this->comfortCategory = ComfortCategory::factory()->create(['name' => 'First']);
        $this->employee = Employee::factory()->create();
        $this->employee->comfortCategories()->attach($this->comfortCategory);

        $this->driver = Driver::factory()->create();

        $this->car = Car::factory()->create([
            'comfort_category_id' => $this->comfortCategory->id,
            'driver_id' => $this->driver->id,
        ]);
    }

    /** @test */
    public function it_returns_available_cars()
    {
        // Данные запроса
        $response = $this->json('GET','/api/available-cars', [
            'employee_id' => $this->employee->id,
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDays(2)->toDateTimeString(),
        ]);

        // Проверка ответа
        $response->assertStatus(200)
            ->assertJsonFragment([
                'model' => $this->car->model,
                'comfort_category' => $this->comfortCategory->name,
                'driver' => [
                    'id' => $this->driver->id,
                    'name' => $this->driver->name,
                ],
            ]);
    }

    /** @test */
    public function it_excludes_cars_with_conflicting_trips()
    {
        // Создаём поездку, пересекающуюся с указанным временем
        Trip::factory()->create([
            'employee_id' => $this->employee->id,
            'car_id' => $this->car->id,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDays(2),
        ]);

        // Данные запроса
        $response = $this->json('GET','/api/available-cars', [
            'employee_id' => $this->employee->id,
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDays(2)->toDateTimeString(),
        ]);

        // Проверка ответа
        $response->assertStatus(200)
            ->assertJsonMissing([
                'id' => $this->car->id,
            ]);
    }

    /** @test */
    public function it_validates_request_parameters()
    {
        // Неверные данные запроса
        $response = $this->getJson('/api/available-cars', [
            'employee_id' => 'not-an-id',
            'start_time' => 'invalid-date',
            'end_time' => 'invalid-date',
        ]);

        // Проверка ошибки валидации
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['employee_id', 'start_time', 'end_time']);
    }
}
