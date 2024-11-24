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
        Schema::create('chili_healths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_data_id')->constrained('sensor_datas')->onDelete('cascade');
            $table->string('chili_condition');
            $table->string('nutritional_detection');
            $table->string('physical_damage');
            $table->string('chili_disease');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chili_healths');
    }
};
