<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Sora:wght@100..800&family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dashboard</title>
    <style>
        *{
            font-family: "Varela Round", serif;
            margin: 0;
            padding: 0;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex w-full">
        <!-- Sidebar -->
        <div class="w-1/5 h-screen">
            @include('layouts.sidebar')
        </div>
    
        <!-- Dashboard -->
        <div class="w-4/5 h-screen">
            <!-- Header -->
            <header class="bg-light-green p-4 shadow-md">
                <div class="container mx-auto flex justify-between items-center">
                <img class="w-28" src="{{ asset('img/silombok.png') }}" alt="">
                <div class="text-green-700">
                    <span class="text-sm">Last Update: 07/10/2024</span>
                </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="container mx-auto mt-3 space-y-6 p-4">

                <!-- Grid for Measurements -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                 <!-- Suhu -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-dark-green">Suhu</h2>
                    <div class="text-5xl font-bold text-blue-500 mt-4"><span id="temperature"></span> °C</div>
                    <div class="w-full bg-blue-100 rounded-full h-2.5 mt-2">
                        <div id="temperature-indicator" class="bg-blue-500 h-2.5 rounded-full"></div>
                    </div>
                </div>

                <!-- Kelembaban Udara -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-dark-green">Kelembaban Udara</h2>
                    <div class="text-5xl font-bold text-teal-500 mt-4"><span id="humidity"></span> %</div>
                    <div class="w-full bg-teal-100 rounded-full h-2.5 mt-2">
                        <div id="humidity-indicator" class="bg-teal-500 h-2.5 rounded-full"></div>
                    </div>
                </div>
            
                <!-- Kelembaban Tanah -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-dark-green">Kelembaban Tanah</h2>
                    <div class="text-5xl font-bold text-orange-500 mt-4"><span id="soil_moisture"></span></div>
                    <div class="w-full bg-orange-100 rounded-full h-2.5 mt-2">
                        <div id="soil-moisture-indicator" class="bg-orange-500 h-2.5 rounded-full"></div>
                    </div>
                </div>

                <!-- Status Penyiraman Terakhir -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-lg font-semibold text-dark-green">Status Penyiraman Terakhir</h2>
                    <div class="mt-4 flex items-center justify-center">
                    <span class="bg-dark-green text-white px-4 py-1 rounded-full text-sm">Selesai</span>
                    </div>
                    <p class="text-gray-500 mt-2">07/10/2024 - 2 Menit</p>
                </div>
                </div>

                <!-- Riwayat Penyiraman -->
                <section class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-dark-green mb-4">Riwayat Penyiraman</h2>
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="bg-dark-green text-white">
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Durasi</th>
                        <th class="py-3 px-4">Kondisi Tanaman</th>
                        <th class="py-3 px-4">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                        <td class="py-3 px-4">
                            <span class="bg-dark-green text-white px-4 py-1 rounded-full text-sm">Selesai</span>
                        </td>
                        <td class="py-3 px-4">2 Menit</td>
                        <td class="py-3 px-4">Tanaman Cabai - Sehat</td>
                        <td class="py-3 px-4">07/10/2024</td>
                        </tr>
                        <tr class="bg-green-50">
                        <td class="py-3 px-4">
                            <span class="bg-dark-yellow text-white px-4 py-1 rounded-full text-sm">Disiram</span>
                        </td>
                        <td class="py-3 px-4">2 Menit</td>
                        <td class="py-3 px-4">Tanaman Cabai - Sehat</td>
                        <td class="py-3 px-4">07/10/2024</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </section>
            </main>
   
            <!-- Footer -->
            <footer class="mt-3">
                <div class="container mx-auto text-center">
                    <span>&copy; 2024 Silombok. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>

    @if (session('loginAlert'))
        <script>
            Swal.fire({
                title: 'Login Berhasil!',
                text: 'Anda berhasil login ke sistem.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- JavaScript untuk mengambil data sensor dan memperbarui indikator -->
    <script>
        $(document).ready(function() {
            function fetchLatestSensorData() {
                $.ajax({
                    url: '{{ url('/api/sensor-data') }}', // Ganti dengan endpoint API Anda
                    method: 'GET',
                    success: function(response) {
                        if (response.data) {
                            var temperature = response.data.temperature;
                            var humidity = response.data.humidity;
                            var soilMoisture = response.data.soil_moisture;

                            // Perbarui nilai sensor
                            $('#temperature').text(temperature);
                            $('#humidity').text(humidity);
                            $('#soil_moisture').text(soilMoisture);

                            // Sesuaikan lebar indikator dengan nilai sensor
                            $('#temperature-indicator').css('width', (temperature / 80) * 100 + '%'); // Suhu maksimal 80°C
                            $('#humidity-indicator').css('width', humidity + '%'); // Kelembaban maksimal 100%
                            $('#soil-moisture-indicator').css('width', (soilMoisture / 4095) * 100 + '%'); // Kelembaban tanah maksimal 4095

                            // Notifikasi jika nilai sensor melebihi batas maksimal
                            if (temperature > 80 || humidity > 100 || soilMoisture > 4095) {
                                var message = 'Nilai sensor melebihi batas maksimal:\n';
                                if (temperature > 80) message += `- Suhu: ${temperature}°C\n`;
                                if (humidity > 100) message += `- Kelembaban Udara: ${humidity}%\n`;
                                if (soilMoisture > 4095) message += `- Kelembaban Tanah: ${soilMoisture}\n`;
                                
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan',
                                    text: message,
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching sensor data:', error);
                    }
                });
            }

            // Polling data setiap 5 detik
            setInterval(fetchLatestSensorData, 5000);

            // Panggil fungsi untuk pertama kalinya saat halaman dimuat
            fetchLatestSensorData();
        });
    </script>    
</body>
</html>

