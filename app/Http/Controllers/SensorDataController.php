<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'soil_moisture' => 'required|numeric',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        // Menyimpan data sensor ke tabel sensor_data
        $sensorData = SensorData::create($validatedData);

        // // Menyimpan file gambar ke direktori penyimpanan
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);

        //     // Menyimpan path gambar ke database (misalnya tabel images atau pada tabel sensor_data jika ada kolom image_path)
        //     // Jika tabel sensor_data memiliki kolom image_path
        //     $sensorData->update(['image_path' => 'images/' . $imageName]);
        // }

        return response()->json(['message' => 'Data saved successfully', 'data' => $sensorData], 200);
    }

    public function index()
    {
        $latestSensorData = SensorData::latest('created_at')->first();
        return response()->json(['data' => $latestSensorData], 200);
    }

    public function upload(Request $request)
    {
        // Periksa apakah file gambar diterima
        if ($request->hasFile('image')) {
            // Simpan gambar ke direktori public/images
            $path = $request->file('image')->store('images', 'public');

            // Simpan data ke database
            $data = SensorData::create([
                'image' => $path,
            ]);

            return response()->json([
                'message' => 'Data berhasil disimpan.',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'message' => 'Gambar tidak ditemukan.',
        ], 400);
    }
}
