# Food Store Docker Setup

Panduan ini menjelaskan cara menjalankan aplikasi Food Store menggunakan Docker.

## Persyaratan

- Docker dan Docker Compose terinstal di sistem Anda
- Git (opsional, untuk mengkloning repositori)
- PowerShell (untuk Windows)

## Catatan Penting

Jika Anda mengalami masalah jaringan atau DNS saat membangun image Docker, silakan lihat [DNS-TROUBLESHOOTING.md](./DNS-TROUBLESHOOTING.md) untuk panduan pemecahan masalah.

Jika Anda mengalami masalah koneksi ke GitHub API saat membangun image Docker (seperti error "Failed to download ... from dist: curl error 28 while downloading https://api.github.com"), silakan lihat [GITHUB-CONNECTION-FIX.md](./GITHUB-CONNECTION-FIX.md) untuk solusi dan panduan pemecahan masalah.

## Cara Menjalankan Aplikasi

### Metode 1: Menggunakan Skrip PowerShell (Windows)

1. Jalankan skrip PowerShell yang telah disediakan:
   ```powershell
   .\docker-setup.ps1
   ```
   Skrip ini akan otomatis:
   - Memeriksa apakah Docker terinstal
   - Menyalin .env.docker ke .env jika belum ada
   - Membangun dan menjalankan container Docker
   - Menjalankan perintah Laravel yang diperlukan

2. Akses aplikasi di browser:
   ```
   http://localhost:8080
   ```

### Metode 2: Menjalankan Secara Manual

1. Clone repositori (jika belum dilakukan)
   ```bash
   git clone <repository-url>
   cd food-store
   ```

2. Salin file .env.docker menjadi .env (jika belum ada)
   ```bash
   copy .env.docker .env   # Windows
   # atau
   cp .env.docker .env     # Linux/Mac
   ```

3. Sesuaikan konfigurasi database di file .env
   ```
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=db_food_store
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Build dan jalankan container Docker
   ```bash
   docker-compose up -d --build
   ```

5. Masuk ke container Apache untuk menjalankan perintah Laravel
   ```bash
   docker exec -it container-apache bash
   ```

6. Di dalam container, jalankan perintah berikut:
   ```bash
   # Install dependencies (jika belum)
   composer install
   
   # Generate application key (jika belum)
   php artisan key:generate
   
   # Jalankan migrasi database
   php artisan migrate
   
   # Jalankan seeder (opsional)
   php artisan db:seed
   ```

7. Akses aplikasi di browser
   ```
   http://localhost:8080
   ```

## Layanan yang Tersedia

- **Apache**: Web server dengan PHP terintegrasi (port 8080)
- **PHP-FPM**: PHP FastCGI Process Manager
- **Node.js**: Untuk membangun aset frontend
- **MySQL**: Database server (port 3306)

## Konfigurasi Alternatif dengan Nginx

Proyek ini juga menyediakan konfigurasi alternatif menggunakan Nginx sebagai web server. Untuk menggunakan Nginx:

```bash
docker-compose -f docker-compose.nginx.yml up -d --build
```

Konfigurasi Nginx tersedia di `docker/nginx/nginx.conf`.

## Perintah Docker Compose Berguna

- Memulai layanan: `docker-compose up -d`
- Menghentikan layanan: `docker-compose down`
- Melihat log: `docker-compose logs -f [service_name]`
- Membangun ulang container: `docker-compose up -d --build [service_name]`
- Menghapus volume: `docker-compose down -v`
- Menggunakan file compose alternatif: `docker-compose -f [filename.yml] up -d`

## Struktur Dockerfile

- **apache.Dockerfile**: Konfigurasi untuk Apache dengan PHP
- **php.Dockerfile**: Konfigurasi untuk PHP-FPM
- **node.Dockerfile**: Konfigurasi untuk Node.js
- **db.Dockerfile**: Konfigurasi untuk MySQL

## File Konfigurasi Docker

- **docker-compose.yml**: Konfigurasi utama menggunakan Apache
- **docker-compose.nginx.yml**: Konfigurasi alternatif menggunakan Nginx
- **.env.docker**: Contoh konfigurasi lingkungan untuk Docker
- **docker-setup.ps1**: Skrip PowerShell untuk menyiapkan lingkungan Docker
- **docker/mysql/my.cnf**: Konfigurasi MySQL
- **docker/nginx/nginx.conf**: Konfigurasi Nginx

## Troubleshooting

- **Masalah Izin**: Jika ada masalah izin pada file storage, jalankan perintah berikut di dalam container:
  ```bash
  chown -R www-data:www-data storage bootstrap/cache
  chmod -R 775 storage bootstrap/cache
  ```

- **Koneksi Database Gagal**: Pastikan konfigurasi database di .env sudah benar dengan host `mysql` bukan `127.0.0.1` atau `localhost`

- **Perubahan Tidak Terlihat**: Coba bersihkan cache dengan perintah:
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan view:clear
  ```