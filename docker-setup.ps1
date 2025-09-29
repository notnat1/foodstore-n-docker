# Script untuk menyiapkan dan menjalankan Docker untuk Food Store

Write-Host "=== Food Store Docker Setup ==="
Write-Host "Mempersiapkan lingkungan Docker untuk aplikasi Food Store..."

# Memeriksa apakah Docker terinstal
try {
    docker --version
    Write-Host "Docker terinstal. Melanjutkan..."
}
catch {
    Write-Host "Docker tidak terinstal atau tidak berjalan. Silakan instal Docker terlebih dahulu." -ForegroundColor Red
    exit 1
}

# Memeriksa apakah .env sudah ada
if (-not (Test-Path -Path ".env")) {
    Write-Host "File .env tidak ditemukan. Menyalin dari .env.docker..." -ForegroundColor Yellow
    Copy-Item -Path ".env.docker" -Destination ".env"
    Write-Host "File .env dibuat dari .env.docker" -ForegroundColor Green
}
else {
    Write-Host "File .env sudah ada. Pastikan konfigurasi database sudah benar untuk Docker." -ForegroundColor Yellow
    Write-Host "DB_HOST harus diatur ke 'mysql' bukan 'localhost' atau '127.0.0.1'" -ForegroundColor Yellow
}

# Membangun dan menjalankan container Docker
Write-Host "Membangun dan menjalankan container Docker..." -ForegroundColor Cyan
docker-compose up -d --build

if ($LASTEXITCODE -eq 0) {
    Write-Host "Container Docker berhasil dijalankan!" -ForegroundColor Green
    
    # Menunggu MySQL siap
    Write-Host "Menunggu MySQL siap..." -ForegroundColor Cyan
    Start-Sleep -Seconds 10
    
    # Menjalankan perintah Laravel di dalam container
    Write-Host "Menjalankan perintah Laravel di dalam container..." -ForegroundColor Cyan
    docker exec container-apache composer install --ignore-platform-reqs
    docker exec container-apache php artisan key:generate --no-interaction
    docker exec container-apache php artisan migrate --no-interaction
    
    Write-Host "\nSetup selesai! Aplikasi Food Store sekarang berjalan di:" -ForegroundColor Green
    Write-Host "http://localhost:8080" -ForegroundColor Cyan
    
    Write-Host "\nPerintah berguna:" -ForegroundColor Yellow
    Write-Host "- Melihat log: docker-compose logs -f" -ForegroundColor Gray
    Write-Host "- Masuk ke container: docker exec -it container-apache bash" -ForegroundColor Gray
    Write-Host "- Menghentikan container: docker-compose down" -ForegroundColor Gray
}
else {
    Write-Host "Terjadi kesalahan saat menjalankan container Docker." -ForegroundColor Red
}