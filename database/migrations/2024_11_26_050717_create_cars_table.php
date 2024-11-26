<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->foreignId('comfort_category_id');
            $table->foreignId('driver_id');

            $table->timestamps();

            $table->foreign('comfort_category_id')
                ->references('id')
                ->on('comfort_categories');

            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
