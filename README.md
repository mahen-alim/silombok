# Sistem Cerdas Prediksi Kesehatan Buah Cabai & Monitoring Kondisi Tanaman Cabai

Website ini dirancang untuk memberikan prediksi akurat terkait dengan penyakit pada buah cabai dengan integrasi pada perangkat IoT (ESP32 Wrover CAM). Sistem akan melakukan prediksi dari input yang didapat setelah ESP32 Wrover CAM melakukan pemotretan pada buah cabai dan hasil prediksi akan muncul sesuai kondisi aslinya. Sistem ini juga mendukung pemantauan kondisi kelembaban tanah pada tanaman cabai dan suhu udara sekitar, yang nantinya akan menjadi tolak ukur penyiraman otomatis bisa dilakukan atau tidak sesuai kadar kelembaban dan suhu yang telah ditetapkan.

## Daftar Pengguna
Website ini hanya memilki 1 jenis pengguna, yaitu:

**Admin/Pengelola Kebun**
   - Melihat indikator suhu & kelembaban udara secara langsung (real-time).
   - Melihat indikator kelembaban tanah secara langsung (real-time). 
   - Melihat riwayat penyiraman tanaman cabai, setelah proses penyiraman selesai.
   - Mengambil foto buah cabai untuk menghasilkan prediksi penyakitnya.
   - Mendapatkan rekomendasi perawatan terbaik jika hasil prediksi pada buah cabai kurang sehat.

## Fitur Utama

- **Penyiraman Otomatis**  
  Admin dapat mengetahui kapan saatnya sistem akan melakukan penyiraman otomatis sesuai dengan tolak ukur yang sudah ditetapkan pada sistem.

- **Prediksi Kesehatan Buah Cabai**  
  Admin akan mendapatkan sebuah prediksi kesehatan pada buah cabai setelah melakukan pemotretan pada buah cabai. Hasil prediksi akan menentukan rekomendasi perawatan seperti apa yang cocok 
  diterapkan pada tanaman cabai tersebut.

## Instalasi

1. Clone repository ini ke dalam folder lokal Anda :
    ```bash
    git clone https://github.com/mahen-alim/silombok.git
    ```

2. Instal dependensi yang diperlukan :
    ```bash
    cd silombok
    npm install
    ```

3. Tambahkan file `.env` dengan menyalin file `.env.example` :
   ```bash
   cp .env.example .env
   ```

4. Buat kunci aplikasi (APP_KEY) di file `.env` :
   ```bash
   php artisan key:generate
   ```

5. Konfigurasi basis data MySQL (XAMPP, Laragon, DBeaver, dll). Sesuaikan pengaturan koneksi database di file `.env` .
   
6. Jalankan package tailwind css di mode development :
   ```bash
   npm run dev
   ```

7. Jalankan aplikasi pada web browser :
    ```bash
    php artisan serve
    ```

8. Akses aplikasi melalui browser di `http://localhost:8000` atau alamat IP laptop masing-masing.
    
9. Akses dan panduan penggunaan backend server untuk menjalankan model latih dapat diakses pada link berikut :
   https://github.com/mahen-alim/silombok_backend

## Teknologi yang Digunakan

- **Frontend**: HTML5, Javascript, Tailwind CSS.
- **Backend**: PHP, Node.js.
- **Database**: MySQL (XAMPP, Laragon, DBeaver, dll).
- **Authentication**: DB Seeder untuk akun admin.
- **Version Control**: Git, GitHub.

## Penggunaan

**Login Admin/Pengelola Kebun**:  
   Username: `admin`  
   Password: `4dmin_l0mbok`

## Kontribusi

Jika Anda ingin berkontribusi dalam pengembangan proyek ini, silakan lakukan **fork** repository ini dan kirimkan **pull request** dengan deskripsi perubahan yang jelas.

## Kontak

Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami di:  
- Email: mahennekkers27@gmail.com
- No. WA: 0895807400305

---
