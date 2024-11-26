<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_comfort_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('comfort_category_id');
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');

            $table->foreign('comfort_category_id')
                ->references('id')
                ->on('comfort_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_comfort_category');
    }
};