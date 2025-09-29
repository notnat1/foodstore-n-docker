# Script untuk memeriksa koneksi ke GitHub API dari dalam container Docker

# Fungsi untuk memeriksa apakah Docker sedang berjalan
function Test-DockerRunning {
    try {
        $dockerInfo = docker info 2>&1
        if ($LASTEXITCODE -ne 0) {
            Write-Host "[ERROR] Docker tidak berjalan. Silakan jalankan Docker Desktop terlebih dahulu." -ForegroundColor Red
            return $false
        }
        return $true
    } catch {
        Write-Host "[ERROR] Docker tidak terinstall atau tidak berjalan: $_" -ForegroundColor Red
        return $false
    }
}

# Fungsi untuk memeriksa apakah container ada
function Test-ContainerExists {
    param (
        [string]$containerName
    )
    
    $container = docker ps -a --filter "name=$containerName" --format "{{.Names}}" 2>&1
    if ($LASTEXITCODE -ne 0 -or [string]::IsNullOrEmpty($container)) {
        return $false
    }
    return $true
}

# Fungsi untuk memeriksa apakah container sedang berjalan
function Test-ContainerRunning {
    param (
        [string]$containerName
    )
    
    $container = docker ps --filter "name=$containerName" --format "{{.Names}}" 2>&1
    if ($LASTEXITCODE -ne 0 -or [string]::IsNullOrEmpty($container)) {
        return $false
    }
    return $true
}

# Fungsi untuk memeriksa koneksi ke GitHub API
function Test-GitHubConnection {
    param (
        [string]$containerName
    )
    
    Write-Host "\n[INFO] Memeriksa koneksi ke GitHub API dari container $containerName..." -ForegroundColor Cyan
    
    # Memeriksa konfigurasi DNS
    Write-Host "\n[INFO] Konfigurasi DNS dalam container:" -ForegroundColor Yellow
    docker exec $containerName cat /etc/resolv.conf
    
    # Memeriksa koneksi ke api.github.com dengan ping
    Write-Host "\n[INFO] Mencoba ping ke api.github.com:" -ForegroundColor Yellow
    docker exec $containerName ping -c 4 api.github.com
    
    # Memeriksa koneksi ke api.github.com dengan curl
    Write-Host "\n[INFO] Mencoba curl ke api.github.com:" -ForegroundColor Yellow
    docker exec $containerName curl -v https://api.github.com/zen
    
    # Memeriksa koneksi ke api.github.com dengan traceroute
    Write-Host "\n[INFO] Mencoba traceroute ke api.github.com:" -ForegroundColor Yellow
    docker exec $containerName traceroute api.github.com
    
    # Memeriksa konfigurasi jaringan
    Write-Host "\n[INFO] Konfigurasi jaringan dalam container:" -ForegroundColor Yellow
    docker exec $containerName ip addr
    docker exec $containerName ip route
    
    # Memeriksa konfigurasi Composer
    Write-Host "\n[INFO] Konfigurasi Composer dalam container:" -ForegroundColor Yellow
    docker exec $containerName composer config --list --global
}

# Main script
if (-not (Test-DockerRunning)) {
    exit 1
}

# Cek container yang tersedia
Write-Host "[INFO] Container yang tersedia:" -ForegroundColor Cyan
docker ps -a --format "table {{.Names}}\t{{.Status}}\t{{.Image}}"

$containerName = Read-Host "Masukkan nama container untuk diperiksa (default: container-php-fpm)"
if ([string]::IsNullOrEmpty($containerName)) {
    $containerName = "container-php-fpm"
}

# Cek apakah container ada
if (-not (Test-ContainerExists -containerName $containerName)) {
    Write-Host "[ERROR] Container $containerName tidak ditemukan" -ForegroundColor Red
    exit 1
}

# Cek apakah container sedang berjalan
if (-not (Test-ContainerRunning -containerName $containerName)) {
    Write-Host "[WARNING] Container $containerName tidak sedang berjalan. Mencoba menjalankan container..." -ForegroundColor Yellow
    docker start $containerName
    
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[ERROR] Gagal menjalankan container $containerName" -ForegroundColor Red
        exit 1
    }
    
    # Tunggu sebentar agar container siap
    Start-Sleep -Seconds 3
}

# Periksa koneksi ke GitHub API
Test-GitHubConnection -containerName $containerName

Write-Host "\n[INFO] Pemeriksaan koneksi ke GitHub API selesai" -ForegroundColor Green