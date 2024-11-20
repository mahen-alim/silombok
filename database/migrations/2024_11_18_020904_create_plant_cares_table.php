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
        Schema::create('plant_cares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_data_id')->constrained('sensor_data')->onDelete('cascade');
            $table->string('watering');
            $table->string('maintenance');
            $table->string('harvest_time');
            $table->string('pyshical_damage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_cares');
    }
};
