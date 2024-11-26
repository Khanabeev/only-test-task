<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/available-cars', [CarController::class, 'availableCars']);
