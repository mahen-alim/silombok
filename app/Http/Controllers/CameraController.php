<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function getFrame(Request $request)
    {
        // URL stream MJPEG dari ESP32-CAM
        $streamUrl = 'http://192.168.1.100:81/stream';  // Sesuaikan dengan IP ESP32-CAM Anda

        // Mengalirkan stream ke client
        return response()->stream(function () use ($streamUrl) {
            $fp = fopen($streamUrl, 'r');
            while (!feof($fp)) {
                echo fread($fp, 1024);  // Mengirim data frame
                flush();  // Membebaskan buffer dan mengirimkan data
            }
            fclose($fp);
        }, 200, [
            "Content-Type" => "multipart/x-mixed-replace; boundary=frame",  // Menunjukkan tipe konten MJPEG
        ]);
    }
}
