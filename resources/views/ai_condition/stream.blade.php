<!DOCTYPE html>
<html>
<head>
    <title>Stream Kamera ESP32</title>
    <style>
        /* Style untuk indikator loading */
        #loading {
            display: none;
            font-size: 20px;
            color: #333;
        }
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #333;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <h1>Stream Kamera ESP32</h1>
    
    <!-- Menampilkan Stream Kamera -->
    <video id="videoStream" width="640" height="480" autoplay>
        <source src="http://192.168.69.196/stream" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Canvas (hidden) untuk menangkap gambar -->
    <canvas id="canvas" style="display:none;"></canvas>

    <!-- Tombol untuk mengambil foto -->
    <button type="button" onclick="capturePhoto()">Ambil Foto</button>

    <!-- Loading Indicator -->
    <div id="loading">
        <div class="spinner"></div> Loading... Please wait.
    </div>

    <h2>Hasil Foto</h2>
    <div id="photos">
        <!-- Foto akan ditampilkan di sini -->
    </div>

    <script>
        function capturePhoto() {
            // Menampilkan indikator loading
            document.getElementById('loading').style.display = 'block';
            
            const video = document.getElementById('videoStream');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            
            // Menyesuaikan ukuran canvas dengan ukuran video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            // Mengambil gambar dari video stream
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Mengonversi gambar menjadi format base64
            const photoData = canvas.toDataURL('image/jpeg');
            
            // Tampilkan foto di halaman
            const imgElement = document.createElement('img');
            imgElement.src = photoData;
            document.getElementById('photos').appendChild(imgElement);
            
            // Kirim foto ke server menggunakan AJAX
            const formData = new FormData();
            formData.append('image', photoData);
            
            // Kirim data foto ke server
            fetch('/api/save-data-upload', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Foto berhasil disimpan:', data);
                
                // Menyembunyikan indikator loading setelah selesai
                document.getElementById('loading').style.display = 'none';
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
                
                // Menyembunyikan indikator loading jika terjadi error
                document.getElementById('loading').style.display = 'none';
            });
        }
    </script>
</body>
</html>
