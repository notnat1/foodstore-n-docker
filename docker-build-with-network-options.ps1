# Script untuk membangun Docker image dengan opsi jaringan yang optimal

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

# Fungsi untuk membangun image dengan berbagai opsi jaringan
function Build-DockerImage {
    param (
        [string]$dockerfile,
        [string]$tag,
        [string]$networkOption
    )
    
    Write-Host "[INFO] Membangun image $tag dengan opsi jaringan: $networkOption" -ForegroundColor Cyan
    
    switch ($networkOption) {
        "host" {
            Write-Host "[INFO] Menggunakan opsi --network host" -ForegroundColor Yellow
            docker build --network host -t $tag -f $dockerfile .
        }
        "dns" {
            Write-Host "[INFO] Menggunakan opsi --dns dengan Google DNS" -ForegroundColor Yellow
            docker build --dns 8.8.8.8 --dns 8.8.4.4 -t $tag -f $dockerfile .
        }
        "compose" {
            Write-Host "[INFO] Menggunakan docker-compose build" -ForegroundColor Yellow
            if ($dockerfile -eq "php.Dockerfile") {
                docker-compose build php-fpm
            } elseif ($dockerfile -eq "apache.Dockerfile") {
                docker-compose build apache
            } elseif ($dockerfile -eq "node.Dockerfile") {
                docker-compose build nodejs
            } else {
                Write-Host "[ERROR] Tidak dapat menentukan service untuk $dockerfile" -ForegroundColor Red
                return $false
            }
        }
        default {
            Write-Host "[INFO] Menggunakan build standar" -ForegroundColor Yellow
            docker build -t $tag -f $dockerfile .
        }
    }
    
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[ERROR] Build gagal dengan opsi $networkOption" -ForegroundColor Red
        return $false
    } else {
        Write-Host "[SUCCESS] Build berhasil dengan opsi $networkOption" -ForegroundColor Green
        return $true
    }
}

# Main script
if (-not (Test-DockerRunning)) {
    exit 1
}

$dockerfile = Read-Host "Masukkan nama Dockerfile (default: php.Dockerfile)"
if ([string]::IsNullOrEmpty($dockerfile)) {
    $dockerfile = "php.Dockerfile"
}

$tag = Read-Host "Masukkan nama tag untuk image (default: food-store-php)"
if ([string]::IsNullOrEmpty($tag)) {
    $tag = "food-store-php"
}

Write-Host ""
Write-Host "Pilih opsi jaringan untuk build:" -ForegroundColor Cyan
Write-Host "1. Standar (tanpa opsi khusus)" -ForegroundColor White
Write-Host "2. Network Host (--network host)" -ForegroundColor White
Write-Host "3. DNS Google (--dns 8.8.8.8 --dns 8.8.4.4)" -ForegroundColor White
Write-Host "4. Docker Compose (menggunakan konfigurasi dari docker-compose.yml)" -ForegroundColor White
Write-Host "5. Coba semua opsi secara berurutan hingga berhasil" -ForegroundColor White

$option = Read-Host "Pilih opsi (1-5)"

switch ($option) {
    "1" { Build-DockerImage -dockerfile $dockerfile -tag $tag -networkOption "standard" }
    "2" { Build-DockerImage -dockerfile $dockerfile -tag $tag -networkOption "host" }
    "3" { Build-DockerImage -dockerfile $dockerfile -tag $tag -networkOption "dns" }
    "4" { Build-DockerImage -dockerfile $dockerfile -tag $tag -networkOption "compose" }
    "5" {
        Write-Host "[INFO] Mencoba semua opsi secara berurutan hingga berhasil" -ForegroundColor Cyan
        
        $options = @("standard", "host", "dns", "compose")
        $success = $false
        
        foreach ($opt in $options) {
            Write-Host ""
            Write-Host "[INFO] Mencoba opsi: $opt" -ForegroundColor Cyan
            $success = Build-DockerImage -dockerfile $dockerfile -tag $tag -networkOption $opt
            
            if ($success) {
                Write-Host "[SUCCESS] Build berhasil dengan opsi: $opt" -ForegroundColor Green
                break
            } else {
                Write-Host "[INFO] Mencoba opsi berikutnya..." -ForegroundColor Yellow
            }
        }
        
        if (-not $success) {
            Write-Host "[ERROR] Semua opsi build gagal" -ForegroundColor Red
        }
    }
    default { 
        Write-Host "[ERROR] Opsi tidak valid" -ForegroundColor Red 
        exit 1
    }
}