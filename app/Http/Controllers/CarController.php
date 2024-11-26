<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableCarsRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarController extends Controller
{
    public function availableCars(AvailableCarsRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $cars = Car::query()
            ->availableCars($validated)
            ->get();

        return CarResource::collection($cars);
    }
}
