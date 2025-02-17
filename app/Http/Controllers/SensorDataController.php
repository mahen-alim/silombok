<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SensorDataController extends Controller
{
    public static $lastFrame = null;
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

    public function stream()
    {
        return view('ai_condition.stream');
    }

    public function saveDataUpload(Request $request)
    {
        // Validasi apakah ada image yang dikirim
        $request->validate([
            'image' => 'required|string',
        ]);

        // Ambil data base64 image
        $photoData = $request->input('image');

        // Menghilangkan prefix base64 (data:image/jpeg;base64,)
        $imageData = explode(',', $photoData)[1];

        // Menyimpan gambar sebagai file
        $imageName = 'photo_' . time() . '.jpg'; // Nama file gambar
        $path = storage_path('app/public/photos/'); // Lokasi penyimpanan gambar

        // Membuat folder jika belum ada
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Menyimpan file gambar
        file_put_contents($path . $imageName, base64_decode($imageData));

        // Simpan path gambar ke database
        $timestamp = now();
        DB::table('sensor_data')->insert([
            'image' => 'storage/photos/' . $imageName,
            'timestamp' => $timestamp,
        ]);

        // Kembalikan respons sukses
        return response()->json(['message' => 'Foto berhasil disimpan']);
    }
}
