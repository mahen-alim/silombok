<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AI Kondisi Tanaman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Sora:wght@100..800&family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Varela Round", serif;
            margin: 0;
            padding: 0;
        }
        /* Efek transisi dan animasi muncul dari atas */
        .animate-slide-down {
            opacity: 0;
            transform: translateY(-20px);
            animation: slide-down 1s ease-out forwards;
        }

        #photo-result{
            opcaity: 0;
            transform: translateX(-20px);
            animation: slide-right 1s ease-out forwards;        
        }

        .name-con, .origin-con, .iclim-con, .type-con{
            opcaity: 0;
            transform: translateX(20px);
        }
        .name-con{
            animation: slide-left 0.3s ease-in forwards;        
        }
        .origin-con{
            animation: slide-left 0.5s ease-in forwards;        
        }
        .iclim-con{
            animation: slide-left 0.8s ease-in forwards;        
        }
        .type-con{
            animation: slide-left 1.1s ease-in forwards;        
        }
        
        #prediction-card {
            position: relative;
            transition: box-shadow 0.3s ease-in-out;
        }
        
        .shadow-top {
            position: relative;
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.1); /* Shadow pada border top */
        }
        
        #camera, .button-container{
            animation: slide-up 0.5s ease-in forwards;        
        }

        /* Keyframes untuk animasi slide-down */
        @keyframes slide-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-right{
            0%{
                opacity: 0;
                transform: translateX(-20px);
            }
            100%{
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-left{
            0%{
                opacity: 0;
                transform: translateX(20px);
            }
            100%{
                opacity: 1;
                transform: translateX(0);
            }
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
    
        <!-- PLant Condition -->
        <div class="w-4/5">
            <header class="flex bg-light-green text-dark-green shadow-md rounded-lg p-6 gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
                <h1 class="text-justify">AI Kondisi Tanaman (Generate AI Kondisi Daun dan Buah Cabai) adalah sebuah fitur berbasis IoT dan AI yang dirancang untuk menganalisis kesehatan daun dan buah cabai secara otomatis menggunakan kamera dan model AI yang telah dilatih. Fitur ini dapat membantu petani atau pengguna untuk mengetahui kondisi tanaman mereka secara real-time dan memberikan rekomendasi tindakan berdasarkan hasil analisis gambar.</h1>
            </header>
            <main class="main-container w-full p-5 gap-3 justify-center flex flex-col">
                <!-- Container Kamera -->
                <div id="camera-container" class="w-full flex justify-center p-5 border-2 border-gray-200 rounded-lg mb-5">
                    <video id="camera" class="w-full max-w-md rounded-lg shadow-lg" autoplay></video>
                </div>
                
                <!-- Tombol untuk mengambil foto -->
                <div class="button-container flex gap-3 w-full">
                    <button id="capture-btn" class="capture-container flex gap-3 justify-center w-full text-white bg-dark-green p-5 rounded-lg">
                        <h1>Ambil Foto Tanaman</h1>  
                    </button>
                </div>
                
                <!-- Container untuk hasil capture, deskripsi, dan prediksi -->
                <div id="result-container" class="w-full flex flex-col h-full hidden">
                    <div class="w-full flex gap-5 h-max">
                        <!-- Hasil Capture -->
                        <img id="photo-result" class="w-1/3 rounded-lg" alt="Hasil Foto Tanaman">
                        
                        <!-- Elemen untuk menampilkan deskripsi tanaman cabai -->
                        <div id="description-card" class="w-2/3 flex flex-col gap-3">
                            <h2 class="w-max text-xl font-bold text-dark-green">Deskripsi Tanaman</h2>
                            <div class="name-con flex justify-start bg-white rounded-lg p-3 border border-gray-200 w-full">
                                <h2 class="text-md font-bold text-black text-center mr-2">Nama Ilmiah:</h2>
                                <h2 class="text-md text-gray-500 text-center">Capsicum frutescens</h2>
                            </div>
                            <div class="origin-con flex justify-start bg-white rounded-lg p-3 border border-gray-200 w-full">
                                <h2 class="text-md font-bold text-black text-center mr-2">Asal Usul:</h2>
                                <h2 class="text-md text-gray-500 text-center">Amerika Tengah & Amerika Selatan</h2>
                            </div>
                            <div class="iclim-con flex justify-start bg-white rounded-lg p-3 border border-gray-200 w-full">
                                <h2 class="text-md font-bold text-black text-center mr-2">Iklim:</h2>
                                <h2 class="text-md text-gray-500 text-center">Iklim Tropis & Subtropis</h2>
                            </div>
                            <div class="type-con flex justify-start bg-white rounded-lg p-3 border border-gray-200 w-full">
                                <h2 class="text-md font-bold text-black text-center mr-2">Jenis Tanaman:</h2>
                                <h2 class="text-md text-gray-500 text-center">Cabai Rawit</h2>
                            </div>
                        </div>
                        
                    </div>
            
                    <!-- Elemen untuk menampilkan hasil prediksi dan rekomendasi perawatan -->
                    <div id="prediction-card" class="flex flex-col gap-3 w-full h-48 overflow-auto mt-5"></div>

                    <!-- Tombol untuk mengulang foto -->
                    <button id="retry-btn" class="retry-container mt-5 bg-gray-500 text-white p-5 rounded-lg hidden">
                        Ulangi Foto
                    </button>
                </div>
            </main>
            
        </div>

        <script>
            const camera = document.getElementById('camera');
            const captureBtn = document.getElementById('capture-btn');
            const retryBtn = document.getElementById('retry-btn');
            const predictionCard = document.getElementById('prediction-card');
            const cameraContainer = document.getElementById('camera-container');
            const resultContainer = document.getElementById('result-container');
            const photoResult = document.getElementById('photo-result');
            let videoStream;
        
            // Fungsi untuk memulai kamera
            async function startCamera() {
                try {
                    videoStream = await navigator.mediaDevices.getUserMedia({ video: true });
                    camera.srcObject = videoStream;
                    cameraContainer.classList.remove('hidden');  // Tampilkan kamera
                    captureBtn.classList.remove('hidden');       // Tampilkan tombol capture
                    resultContainer.classList.add('hidden');     // Sembunyikan hasil capture
                    retryBtn.classList.add('hidden');            // Sembunyikan tombol ulangi
                } catch (error) {
                    console.error('Gagal mengakses kamera:', error);
                }
            }
        
            // Fungsi untuk menangkap foto dari video dan mengirimkannya ke API
            captureBtn.addEventListener('click', async () => {
                const canvas = document.createElement('canvas');
                canvas.width = camera.videoWidth;
                canvas.height = camera.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(camera, 0, 0, canvas.width, canvas.height);
        
                // Menampilkan gambar hasil tangkapan
                const imageDataUrl = canvas.toDataURL('image/jpeg');
                photoResult.src = imageDataUrl;
                resultContainer.classList.remove('hidden');   // Menampilkan hasil capture
                cameraContainer.classList.add('hidden');      // Menyembunyikan kamera
                captureBtn.classList.add('hidden');           // Sembunyikan tombol "Ambil Foto Tanaman"
                retryBtn.classList.remove('hidden');          // Tampilkan tombol "Ulangi Foto"
        
                // Matikan kamera setelah foto diambil
                if (videoStream) {
                    videoStream.getTracks().forEach(track => track.stop());
                }
        
                // Mengirim gambar ke API
                canvas.toBlob(async (blob) => {
                    const formData = new FormData();
                    formData.append('image', blob, 'capture.jpg');
                    
                    // Pastikan URL yang benar
                    const response = await fetch('http://127.0.0.1:5000/predict', { method: 'POST', body: formData });
                    
                    const result = await response.json();
                    
                    // Menampilkan prediksi dan rekomendasi dalam bentuk card di bawah hasil capture
                    predictionCard.innerHTML = `
                        <h2 class="text-xl font-bold text-dark-green">Kondisi Kesehatan Cabai</h2>
                        <div class="flex gap-6 bg-white rounded-lg p-8 border border-gray-200 w-full animate-slide-down relative">
                            <div class="condition-con flex flex-col w-max text-center items-center justify-center">
                                <p class="text-gray-700">Kondisi Buah</p>
                                <strong class="w-max mt-3 p-2 border-2 ${result.prediction === 'Busuk' ? 'border-dark-red text-dark-red bg-light-red' : 'border-green-500 text-green-500 bg-light-green'} rounded-lg">
                                    ${result.prediction}
                                </strong>
                            </div>
                            <div class="disease-con flex flex-col w-max text-center items-center justify-center -mt-2">
                                <p class="text-gray-700 mb-5">Penyakit Cabai</p>
                                <strong>Busuk Buah</strong>
                            </div>
                            <div class="nutrition-con flex flex-col w-max text-center items-center justify-center -mt-2">
                                <p class="text-gray-700 mb-5">Kekurangan Nutrisi</p>
                                <strong>-</strong>
                            </div>
                            <div class="pyshical-con flex flex-col w-max text-center items-center justify-center -mt-2">
                                <p class="text-gray-700 mb-5">Kerusakan Fisik</p>
                                <strong>Bercak Hitam</strong>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-dark-green mt-5">Rekomendasi Perawatan</h2>
                        <div class="bg-white shadow-lg rounded-lg p-5 border border-gray-200 w-full animate-slide-down">
                            <ul class="mt-2 text-gray-700">
                                <li><strong>Penyiraman:</strong> ${result.rekomendasi.penyiraman}</li>
                                <li><strong>Perawatan:</strong> ${result.rekomendasi.perawatan}</li>
                                <li><strong>Perkiraan Waktu Panen:</strong> ${result.rekomendasi.perkiraan_waktu_panen}</li>
                                <li><strong>Kerusakan Fisik:</strong> ${result.rekomendasi.kerusakan_fisik}</li>
                            </ul>
                        </div>
                    `;
                }, 'image/jpeg');
            });
        
            // Fungsi untuk mengulang proses foto
            retryBtn.addEventListener('click', () => {
                startCamera();  // Mulai kamera kembali
            });
        
            // Memulai kamera saat halaman dimuat
            window.addEventListener('load', startCamera);

            // Menambahkan event listener untuk scroll
            predictionCard.addEventListener('scroll', () => {
                if (predictionCard.scrollTop > 0) {
                    predictionCard.classList.add('shadow-top');  // Menambahkan shadow saat digulir
                } else {
                    predictionCard.classList.remove('shadow-top');  // Menghapus shadow saat di awal
                }
            });
        </script>

        {{-- <script>
            // Alamat IP ESP32-CAM untuk stream video
            const esp32CamUrl = "http://<ESP32_CAM_IP>/stream";
            const video = document.getElementById("camera");
            const captureBtn = document.getElementById("capture-btn");
            const cancelBtn = document.getElementById("cancel-btn");
            const cameraContainer = document.getElementById("camera-container");
            const photoCard = document.getElementById("photo-card");
            const photoCanvas = document.getElementById("photo");
            const photoContext = photoCanvas.getContext("2d");
        
            // Menampilkan stream video dari ESP32-CAM
            video.srcObject = null;
            video.src = esp32CamUrl;
            video.play();
        
            // Fungsi untuk mengambil foto dari stream video
            captureBtn.addEventListener("click", () => {
                photoCanvas.width = video.videoWidth;
                photoCanvas.height = video.videoHeight;
                photoContext.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
        
                // Menampilkan hasil foto
                photoCard.classList.remove("hidden");
                cameraContainer.classList.add("hidden");
                cancelBtn.classList.remove("hidden");
                captureBtn.classList.add("hidden");
            });
        
            // Fungsi untuk membatalkan dan kembali ke mode kamera
            cancelBtn.addEventListener("click", () => {
                cameraContainer.classList.remove("hidden");
                photoCard.classList.add("hidden");
                cancelBtn.classList.add("hidden");
                captureBtn.classList.remove("hidden");
            });
        </script> --}}
</body>
</html>