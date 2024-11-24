<?php

use App\Http\Controllers\CameraController;
use App\Http\Controllers\ChiliHealthController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\StreamingController;
use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/predict', function (Request $request) {
    $response = Http::attach(
        'image',
        $request->file('image')->get(),
        'capture.jpg'
    )->post('http://localhost:5000/predict');

    return $response->json();
});

Route::post('/sensor-data', [SensorDataController::class, 'store']);
Route::post('/save-data-upload', [SensorDataController::class, 'upload']);
Route::get('/sensor-data', [SensorDataController::class, 'index']);
Route::post('/save-data', [ChiliHealthController::class, 'store']);
// Mendefinisikan route untuk streaming video
Route::get('/get-frame', [SensorDataController::class, 'getFrame']);

// Mendefinisikan route untuk mengambil foto
Route::post('/save-data-upload', [SensorDataController::class, 'saveDataUpload']);

// Mendefinisikan route untuk mengunggah foto
Route::post('/upload-frame', [SensorDataController::class, 'uploadFrame']);
Route::get('/get-frame', [CameraController::class, 'getFrame']);
Route::get('/photos', function () {
    return SensorData::latest()->get(); // Mengambil foto terbaru dari database
});

Route::post('/api/sensor-data', function (Request $request) {
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $image = $request->file('image');
    $imageData = file_get_contents($image->getRealPath());

    $sensorData = new SensorData();
    $sensorData->temperature = 0; // Sesuaikan dengan data yang relevan
    $sensorData->humidity = 0; // Sesuaikan dengan data yang relevan
    $sensorData->soil_moisture = 0; // Sesuaikan dengan data yang relevan
    $sensorData->esp_cam = $imageData;
    $sensorData->save();

    return response()->json(['message' => 'Data saved successfully']);
});

// Route::post('/get-sensor', [SensorDataController::class, 'get-sensor'])->name('sensor-data');