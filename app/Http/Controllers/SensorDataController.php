<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'soil_moisture' => 'required|numeric'
        ]);

        $sensorData = SensorData::create($validatedData);

        return response()->json(['message' => 'Data saved successfully', 'data' => $sensorData], 200);
    }

    public function index()
    {
        $latestSensorData = SensorData::latest('created_at')->first();
        return response()->json(['data' => $latestSensorData], 200);
    }
}
