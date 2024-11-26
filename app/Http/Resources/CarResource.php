<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'model' => $this->model,
            'comfort_category' => $this->comfortCategory->name,
            'driver' => [
                'id' => $this->driver->id,
                'name' => $this->driver->name,
            ],
        ];
    }
}
