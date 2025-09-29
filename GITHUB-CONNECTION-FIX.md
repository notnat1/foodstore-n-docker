# Mengatasi Masalah Koneksi ke GitHub dalam Docker Build

## Masalah

Saat menjalankan perintah `docker build -t food-store-php -f php.Dockerfile .`, terjadi error koneksi ke `api.github.com` yang menyebabkan kegagalan dalam mengunduh dependensi Composer:

```
Failed to download vlucas/phpdotenv from dist: curl error 28 while downloading https://api.github.com
Failed to download symfony/css-selector from dist: curl error 28 while downloading https://api.github.com
...
```

Error ini menunjukkan bahwa container Docker tidak dapat terhubung ke GitHub API, yang diperlukan untuk mengunduh paket-paket PHP.

## Perubahan yang Telah Diimplementasikan

Beberapa perubahan telah diimplementasikan untuk mengatasi masalah ini:

1. Menambahkan konfigurasi Composer di `php.Dockerfile` dan `apache.Dockerfile`:
   ```dockerfile
   # Configure Composer for better GitHub connectivity
   RUN composer config --global github-protocols https \
       && composer config --global process-timeout 2000
   ```

2. Membuat script PowerShell untuk membantu build Docker image:
   - `build-php-image.ps1`: Script sederhana yang langsung menggunakan opsi yang direkomendasikan (--network host dan --dns Google)
   - `docker-build-with-network-options.ps1`: Script interaktif yang menawarkan berbagai opsi build (standar, network host, DNS Google, docker-compose)

3. Membuat script untuk memeriksa koneksi ke GitHub API dari dalam container:
   - `check-github-connection.ps1`: Script untuk mendiagnosis masalah koneksi ke GitHub API

## Cara Menggunakan Script yang Disediakan

### 1. Menggunakan Script Build Sederhana

Untuk cara tercepat dan termudah, gunakan script `build-php-image.ps1` yang sudah dikonfigurasi dengan opsi yang direkomendasikan:

```powershell
.\build-php-image.ps1
```

Script ini akan membangun image PHP dengan opsi `--network host` dan DNS Google (`8.8.8.8` dan `8.8.4.4`).

### 2. Menggunakan Script Build dengan Berbagai Opsi

Jika cara sederhana tidak berhasil, gunakan script interaktif yang menawarkan berbagai opsi build:

```powershell
.\docker-build-with-network-options.ps1
```

Script ini akan menampilkan menu dengan beberapa opsi build:
1. Build standar (tanpa opsi khusus)
2. Network Host (`--network host`)
3. DNS Google (`--dns 8.8.8.8 --dns 8.8.4.4`)
4. Docker Compose (menggunakan konfigurasi dari `docker-compose.yml`)
5. Coba semua opsi secara berurutan hingga berhasil

### 3. Memeriksa Koneksi ke GitHub API

Jika masih mengalami masalah, gunakan script untuk mendiagnosis koneksi ke GitHub API:

```powershell
.\check-github-connection.ps1
```

Script ini akan memeriksa koneksi ke GitHub API dari dalam container Docker, termasuk:
- Konfigurasi DNS
- Ping ke api.github.com
- Curl ke api.github.com
- Traceroute ke api.github.com
- Konfigurasi jaringan
- Konfigurasi Composer

## Solusi Lainnya

Jika script-script di atas tidak menyelesaikan masalah, berikut beberapa solusi tambahan yang dapat dicoba:

### 1. Periksa Koneksi Internet dan Firewall

- Pastikan komputer Anda memiliki koneksi internet yang stabil
- Periksa apakah ada firewall atau software keamanan yang memblokir koneksi ke GitHub
- Coba gunakan VPN jika jaringan Anda membatasi akses ke GitHub

### 2. Gunakan Cache Composer Lokal

Gunakan cache Composer lokal dengan mounting volume saat build:

```bash
docker build -t food-store-php -f php.Dockerfile --volume ${HOME}/.composer:/root/.composer .
```

### 3. Instal Dependensi Secara Lokal

Instal dependensi secara lokal terlebih dahulu, lalu build Docker image:

```bash
composer install --ignore-platform-reqs
docker build -t food-store-php -f php.Dockerfile .
```

### 4. Gunakan Image Docker yang Sudah Siap

Jika memungkinkan, gunakan image Docker yang sudah memiliki semua dependensi terinstal.

Semoga solusi-solusi ini dapat membantu mengatasi masalah koneksi ke GitHub saat proses build Docker.