<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiliHealth;
use App\Models\PlantCare;
use App\Models\SensorData;

class ChiliHealthController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chili_condition' => 'required|string',
            'nutritional_detection' => 'required|string',
            'physical_damage' => 'required|string',
            'chili_disease' => 'required|string',
            'watering' => 'required|string',
            'maintenance' => 'required|string',
            'harvest_time' => 'required|string',
            'pyshical_damage' => 'required|string',
            // Validasi lainnya sesuai kebutuhan
        ]);

        // Membuat entri baru di tabel `sensor_data`
        $sensorData = SensorData::create([
            // Data sensor yang relevan, sesuaikan sesuai kebutuhan Anda
            'temperature' => 0,
            'humidity' => 0,
            'soil_moisture' => 0,
        ]);

        // Menyimpan data ke tabel `chili_healths`
        $chiliHealth = ChiliHealth::create([
            'sensor_data_id' => $sensorData->id,
            'chili_condition' => $request->chili_condition,
            'nutritional_detection' => $request->nutritional_detection,
            'physical_damage' => $request->physical_damage,
            'chili_disease' => $request->chili_disease,
        ]);

        // Menyimpan data ke tabel `plant_cares`
        $plantCare = PlantCare::create([
            'sensor_data_id' => $sensorData->id,
            'watering' => $request->watering,
            'maintenance' => $request->maintenance,
            'harvest_time' => $request->harvest_time,
            'pyshical_damage' => $request->pyshical_damage,
        ]);

        return response()->json(['message' => 'Data saved successfully', 'data' => ['chili_health' => $chiliHealth, 'plant_care' => $plantCare]], 200);
    }
}
