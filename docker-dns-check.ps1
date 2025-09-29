# Script untuk memeriksa resolusi DNS di dalam container Docker

Write-Host "=== Docker DNS Resolution Check ===" -ForegroundColor Cyan
Write-Host "Script ini akan memeriksa resolusi DNS di dalam container Docker." -ForegroundColor Cyan
Write-Host ""

# Memeriksa apakah Docker terinstal dan berjalan
try {
    docker --version | Out-Null
    Write-Host "Docker terinstal dan berjalan." -ForegroundColor Green
}
catch {
    Write-Host "Docker tidak terinstal atau tidak berjalan. Silakan instal dan jalankan Docker terlebih dahulu." -ForegroundColor Red
    exit 1
}

# Memeriksa apakah container Apache berjalan
$containerRunning = docker ps --filter "name=container-apache" --format "{{.Names}}" 2>$null

if ($containerRunning -eq "container-apache") {
    Write-Host "Container Apache ditemukan dan sedang berjalan." -ForegroundColor Green
    
    # Memeriksa resolusi DNS di dalam container
    Write-Host "\nMemeriksa resolusi DNS di dalam container..." -ForegroundColor Cyan
    
    Write-Host "\n1. Memeriksa file /etc/resolv.conf:" -ForegroundColor Yellow
    docker exec container-apache cat /etc/resolv.conf
    
    Write-Host "\n2. Mencoba ping ke deb.debian.org:" -ForegroundColor Yellow
    docker exec container-apache ping -c 4 deb.debian.org
    
    Write-Host "\n3. Mencoba ping ke google.com:" -ForegroundColor Yellow
    docker exec container-apache ping -c 4 google.com
    
    Write-Host "\n4. Memeriksa konfigurasi jaringan:" -ForegroundColor Yellow
    docker exec container-apache ip addr
    
    Write-Host "\n5. Memeriksa rute jaringan:" -ForegroundColor Yellow
    docker exec container-apache ip route
    
    Write-Host "\nPemeriksaan DNS selesai." -ForegroundColor Green
    Write-Host "Jika Anda masih mengalami masalah, silakan lihat DNS-TROUBLESHOOTING.md untuk panduan lebih lanjut." -ForegroundColor Cyan
}
else {
    Write-Host "Container Apache tidak ditemukan atau tidak berjalan." -ForegroundColor Yellow
    Write-Host "Apakah Anda ingin menjalankan pemeriksaan DNS pada container lain? (y/n)" -ForegroundColor Yellow
    $response = Read-Host
    
    if ($response -eq "y") {
        Write-Host "\nContainer yang tersedia:" -ForegroundColor Cyan
        docker ps --format "{{.Names}}"
        
        Write-Host "\nMasukkan nama container yang ingin diperiksa:" -ForegroundColor Yellow
        $containerName = Read-Host
        
        if ($containerName) {
            Write-Host "\nMemeriksa resolusi DNS di dalam container $containerName..." -ForegroundColor Cyan
            
            Write-Host "\n1. Memeriksa file /etc/resolv.conf:" -ForegroundColor Yellow
            docker exec $containerName cat /etc/resolv.conf
            
            Write-Host "\n2. Mencoba ping ke deb.debian.org:" -ForegroundColor Yellow
            docker exec $containerName ping -c 4 deb.debian.org
            
            Write-Host "\n3. Mencoba ping ke google.com:" -ForegroundColor Yellow
            docker exec $containerName ping -c 4 google.com
            
            Write-Host "\nPemeriksaan DNS selesai." -ForegroundColor Green
            Write-Host "Jika Anda masih mengalami masalah, silakan lihat DNS-TROUBLESHOOTING.md untuk panduan lebih lanjut." -ForegroundColor Cyan
        }
        else {
            Write-Host "Nama container tidak valid." -ForegroundColor Red
        }
    }
    else {
        Write-Host "Pemeriksaan dibatalkan." -ForegroundColor Yellow
    }
}