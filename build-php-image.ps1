# Script sederhana untuk membangun image PHP dengan opsi yang direkomendasikan

# Periksa apakah Docker berjalan
try {
    $dockerInfo = docker info 2>&1
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[ERROR] Docker tidak berjalan. Silakan jalankan Docker Desktop terlebih dahulu." -ForegroundColor Red
        exit 1
    }
} catch {
    Write-Host "[ERROR] Docker tidak terinstall atau tidak berjalan: $_" -ForegroundColor Red
    exit 1
}

Write-Host "[INFO] Membangun image food-store-php dengan opsi yang direkomendasikan..." -ForegroundColor Cyan
Write-Host "[INFO] Menggunakan opsi --network host dan --dns dengan Google DNS" -ForegroundColor Yellow

# Jalankan build dengan opsi yang direkomendasikan
docker build --network host --dns 8.8.8.8 --dns 8.8.4.4 -t food-store-php -f php.Dockerfile .

if ($LASTEXITCODE -ne 0) {
    Write-Host "[ERROR] Build gagal dengan opsi yang direkomendasikan" -ForegroundColor Red
    Write-Host "[INFO] Untuk opsi build lainnya, silakan gunakan script docker-build-with-network-options.ps1" -ForegroundColor Yellow
    Write-Host "[INFO] Untuk memeriksa koneksi ke GitHub API, silakan gunakan script check-github-connection.ps1" -ForegroundColor Yellow
    exit 1
} else {
    Write-Host "[SUCCESS] Build berhasil!" -ForegroundColor Green
    Write-Host "[INFO] Image food-store-php berhasil dibuat" -ForegroundColor Cyan
}