# Script untuk membangun Docker image Node.js food-store
# Menggunakan opsi yang direkomendasikan untuk mengatasi masalah build

Write-Host "=== Food Store Node.js Docker Image Builder ===" -ForegroundColor Green
Write-Host ""

# Cek apakah Docker berjalan
Write-Host "Memeriksa status Docker..." -ForegroundColor Yellow
try {
    docker version | Out-Null
    Write-Host "✓ Docker berjalan dengan baik" -ForegroundColor Green
} catch {
    Write-Host "✗ Docker tidak berjalan atau tidak terinstall" -ForegroundColor Red
    Write-Host "Pastikan Docker Desktop sudah berjalan" -ForegroundColor Yellow
    exit 1
}

Write-Host ""
Write-Host "Membangun image food-store-node..." -ForegroundColor Yellow
Write-Host "Menggunakan opsi: --network host dan DNS 8.8.8.8, 8.8.4.4" -ForegroundColor Cyan
Write-Host ""

# Build dengan opsi yang direkomendasikan
$buildCommand = "docker build -t food-store-node -f node.Dockerfile --network host --dns 8.8.8.8 --dns 8.8.4.4 ."

Write-Host "Menjalankan: $buildCommand" -ForegroundColor Cyan
Invoke-Expression $buildCommand

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "✓ Image food-store-node berhasil dibangun!" -ForegroundColor Green
    Write-Host ""
    Write-Host "Untuk menjalankan container:" -ForegroundColor Yellow
    Write-Host "docker run -p 3000:3000 food-store-node" -ForegroundColor Cyan
} else {
    Write-Host ""
    Write-Host "✗ Build gagal!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Jika masih ada masalah, coba:" -ForegroundColor Yellow
    Write-Host "1. Jalankan: .\docker-build-with-network-options.ps1" -ForegroundColor Cyan
    Write-Host "2. Pilih node.Dockerfile dan food-store-node sebagai tag" -ForegroundColor Cyan
    Write-Host "3. Atau coba opsi build yang berbeda" -ForegroundColor Cyan
    exit 1
}