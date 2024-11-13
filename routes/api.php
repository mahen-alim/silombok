<?php

use App\Http\Controllers\SensorDataController;
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
