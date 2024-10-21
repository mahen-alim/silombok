<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Penyiraman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Sora:wght@100..800&family=Varela+Round&display=swap" rel="stylesheet">
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
        <div class="w-1/5">
            @include('layouts.sidebar')
        </div>
    
        <!-- PLant Condition -->
        <div class="w-4/5 h-screen">
            <header class="flex bg-light-green text-dark-green shadow-md rounded-lg p-6 gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
                <h1>Jadwalkan penyiraman pada tanaman cabai Anda dan sistem akan melakukan penyiraman otomatis sesuai jadwal yang telah ditentukan.</h1>
            </header>
            <!-- Container for the Schedule Settings -->
            <main class="container mx-auto">
                <div class="bg-white shadow-md rounded-lg p-6 space-y-6 mt-1">
                    <!-- Header -->
                    <h2 class="text-lg font-bold text-dark-green">Pengaturan Jadwal Penyiraman</h2>
                    
                    <!-- Form for Adding/Editing Schedule -->
                    <form class="space-y-4">
                        
                        <!-- Pilih Hari -->
                        <div>
                        <label class="block text-sm font-medium text-green-900" for="days">Pilih Hari</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Senin">
                                <span class="ml-2 text-sm">Senin</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Selasa">
                                <span class="ml-2 text-sm">Selasa</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Rabu">
                                <span class="ml-2 text-sm">Rabu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Kamis">
                                <span class="ml-2 text-sm">Kamis</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Jumat">
                                <span class="ml-2 text-sm">Jumat</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Sabtu">
                                <span class="ml-2 text-sm">Sabtu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500" name="days" value="Minggu">
                                <span class="ml-2 text-sm">Minggu</span>
                            </label>
                        </div>
                        </div>

                        <!-- Pilih Waktu -->
                        <div>
                            <label class="block text-sm font-medium text-green-900" for="time">Pilih Waktu Penyiraman</label>
                            <input type="time" id="time" name="time" class="mt-2 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-500">
                        </div>

                        <!-- Durasi Penyiraman -->
                        <div>
                            <label class="block text-sm font-medium text-green-900" for="duration">Durasi Penyiraman (menit)</label>
                            <input type="number" id="duration" name="duration" min="1" max="60" class="mt-2 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-500" placeholder="Masukkan durasi (misal: 10)">
                        </div>

                        <!-- Button to Add Schedule -->
                        <div class="flex justify-end space-x-2">
                            <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Reset</button>
                            <button type="submit" class="bg-dark-green text-white px-4 py-2 rounded-lg hover:bg-dark-green2">Tambah Jadwal</button>
                        </div>
                    </form>

                    <!-- Tabel Jadwal Penyiraman -->
                    <section class="mt-6">
                        <h3 class="text-lg font-semibold text-dark-green">Jadwal Penyiraman Terjadwal</h3>
                        <div class="overflow-x-auto mt-4 rounded-lg">
                            <table class="min-w-full text-left text-sm">
                                <thead>
                                <tr class="bg-dark-green text-white">
                                    <th class="py-3 px-4">Hari</th>
                                    <th class="py-3 px-4">Waktu</th>
                                    <th class="py-3 px-4">Durasi (Menit)</th>
                                    <th class="py-3 px-4">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white">
                                    <td class="py-3 px-4">Senin</td>
                                    <td class="py-3 px-4">07:00</td>
                                    <td class="py-3 px-4">10</td>
                                    <td class="py-3 px-4 space-x-2">
                                    <button class="bg-yellow-500 text-white px-4 py-1 rounded-lg hover:bg-yellow-600">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-1 rounded-lg hover:bg-red-600">Hapus</button>
                                    </td>
                                </tr>
                                <tr class="bg-light-green">
                                    <td class="py-3 px-4">Rabu</td>
                                    <td class="py-3 px-4">08:00</td>
                                    <td class="py-3 px-4">15</td>
                                    <td class="py-3 px-4 space-x-2">
                                    <button class="bg-yellow-500 text-white px-4 py-1 rounded-lg hover:bg-yellow-600">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-1 rounded-lg hover:bg-red-600">Hapus</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
</body>
</html>