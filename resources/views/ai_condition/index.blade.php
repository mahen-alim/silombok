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
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        <div class="w-1/5">
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
            <main class="main-container w-full p-5 gap-3 justify-center mt-3">
                <!-- Card untuk menampilkan kamera -->
                <div id="camera-container" class="camera-container w-full flex justify-center p-5 border-2 border-gray-200 rounded-lg mb-5 hidden">
                    <video id="camera" class="w-full max-w-md rounded-lg shadow-lg" autoplay></video>
                </div>
            
                <!-- Tombol untuk mengambil foto -->
                <div class="flex gap-3 w-full">
                    <button id="capture-btn" class="capture-container flex gap-3 justify-center w-full text-white bg-dark-green p-5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        <h1>Ambil Foto Tanaman</h1>  
                    </button>
                    <!-- Tombol Cancel -->
                    <button id="cancel-btn" class="cancel-container flex gap-3 justify-center w-full text-white bg-red-600 p-5 rounded-lg hidden">
                        <h1>Batal</h1>
                    </button>
                </div>
            
                <!-- Card untuk menampilkan hasil foto -->
                <div id="photo-card" class="photo-card w-full flex justify-center p-5 border-2 border-gray-200 rounded-lg mt-5 hidden">
                    <canvas id="photo" class="w-full max-w-md rounded-lg shadow-lg"></canvas>
                </div>
            </main>
        </div>
            
        <script>
            // Akses elemen HTML
            const video = document.getElementById('camera');
            const canvas = document.getElementById('photo');
            const captureBtn = document.getElementById('capture-btn');
            const cancelBtn = document.getElementById('cancel-btn');
            const photoCard = document.getElementById('photo-card');
            const cameraContainer = document.getElementById('camera-container');
            let stream; // Variabel untuk menyimpan stream video
        
            // Event listener ketika tombol "Ambil Foto Tanaman" ditekan
            captureBtn.addEventListener('click', () => {
                if (!stream) {
                    // Menampilkan elemen kamera
                    cameraContainer.classList.remove('hidden');
                    cancelBtn.classList.remove('hidden'); // Tampilkan tombol Cancel
                    
                    // Mengakses kamera perangkat
                    navigator.mediaDevices.getUserMedia({ video: true })
                        .then((s) => {
                            stream = s; // Simpan stream
                            video.srcObject = stream;
                        })
                        .catch((err) => {
                            console.error('Error accessing camera: ', err);
                        });
                } else {
                    // Jika stream sudah ada, ambil foto
                    const context = canvas.getContext('2d');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    // Menampilkan card hasil foto
                    photoCard.classList.remove('hidden');
                }
            });
        
            // Event listener ketika tombol "Batal" ditekan
            cancelBtn.addEventListener('click', () => {
                // Stop video stream
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null; // Reset stream setelah dihentikan
                }
                // Sembunyikan video dan foto card
                video.srcObject = null;
                cameraContainer.classList.add('hidden');
                photoCard.classList.add('hidden');
                cancelBtn.classList.add('hidden'); // Sembunyikan tombol Cancel
            });
        </script>
</body>
</html>