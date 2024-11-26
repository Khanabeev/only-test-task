<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;
    public function comfortCategories(): BelongsToMany
    {
        return $this->belongsToMany(ComfortCategory::class, 'employee_comfort_category');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
