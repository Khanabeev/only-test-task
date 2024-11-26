<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class CarBuilder extends Builder
{
    public function availableCars(array $filters): self
    {
        return $this->whereDoesntHave('trips', function ($query) use ($filters) {
            $query->where(function ($q) use ($filters) {
                $q->whereBetween('start_time', [$filters['start_time'], $filters['end_time']])
                    ->orWhereBetween('end_time', [$filters['start_time'], $filters['end_time']]);
            });
        })
            ->whereHas('comfortCategory', function ($query) use ($filters) {
                $query->whereHas('employees', function ($q) use ($filters) {
                    $q->where('employees.id', $filters['employee_id']); // Исправление
                });
            })
            ->when(!empty($filters['model']), function ($query) use ($filters) {
                $query->where('model', $filters['model']);
            })
            ->when(!empty($filters['comfort_category']), function ($query) use ($filters) {
                $query->whereHas('comfortCategory', function ($q) use ($filters) {
                    $q->where('name', $filters['comfort_category']);
                });
            });
    }
}
