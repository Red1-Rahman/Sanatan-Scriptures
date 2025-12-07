# Sanatan Scriptures - Quick Setup Script for Windows
# Run this script in PowerShell as Administrator

Write-Host "   Sanatan Scriptures - Installation Script" -ForegroundColor Cyan
Write-Host "=============================================" -ForegroundColor Cyan
Write-Host ""

# Check if running as Administrator
$currentPrincipal = New-Object Security.Principal.WindowsPrincipal([Security.Principal.WindowsIdentity]::GetCurrent())
$isAdmin = $currentPrincipal.IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "⚠️  Please run this script as Administrator!" -ForegroundColor Red
    exit
}

# Configuration
$projectPath = "D:\Apps\XAMPP\htdocs\sanatan-scriptures"
$phpPath = "D:\Apps\XAMPP\php\php.exe"
$composerPath = "composer"

Write-Host "📁 Project Path: $projectPath" -ForegroundColor Yellow
Write-Host ""

# Step 1: Check if Composer is installed
Write-Host "Step 1: Checking Composer..." -ForegroundColor Green
try {
    & $composerPath --version | Out-Null
    Write-Host "✓ Composer found" -ForegroundColor Green
}
catch {
    Write-Host "✗ Composer not found. Please install Composer first." -ForegroundColor Red
    exit
}

# Step 2: Navigate to project directory
Write-Host ""
Write-Host "Step 2: Navigating to project directory..." -ForegroundColor Green
Set-Location $projectPath

# Step 3: Install PHP dependencies
Write-Host ""
Write-Host "Step 3: Installing PHP dependencies..." -ForegroundColor Green
& $composerPath install --no-interaction

# Step 4: Copy .env file
Write-Host ""
Write-Host "Step 4: Setting up environment file..." -ForegroundColor Green
if (!(Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    Write-Host "✓ .env file created" -ForegroundColor Green
}
else {
    Write-Host "✓ .env file already exists" -ForegroundColor Yellow
}

# Step 5: Generate application key
Write-Host ""
Write-Host "Step 5: Generating application key..." -ForegroundColor Green
& $phpPath artisan key:generate

# Step 6: Set permissions
Write-Host ""
Write-Host "Step 6: Setting directory permissions..." -ForegroundColor Green
icacls storage /grant Users:F /T | Out-Null
icacls bootstrap/cache /grant Users:F /T | Out-Null
Write-Host "✓ Permissions set" -ForegroundColor Green

# Step 7: Check MySQL connection
Write-Host ""
Write-Host "Step 7: Database Setup" -ForegroundColor Green
Write-Host "---------------------------------------" -ForegroundColor Yellow
Write-Host "Please ensure:" -ForegroundColor Yellow
Write-Host "  1. MySQL is running in XAMPP" -ForegroundColor Yellow
Write-Host "  2. Database 'sanatan_scriptures' is created in phpMyAdmin" -ForegroundColor Yellow
Write-Host "  3. Database credentials in .env are correct" -ForegroundColor Yellow
Write-Host ""
$continue = Read-Host "Database ready? (Y/N)"

if ($continue -eq "Y" -or $continue -eq "y") {
    # Step 8: Run migrations
    Write-Host ""
    Write-Host "Step 8: Running database migrations..." -ForegroundColor Green
    & $phpPath artisan migrate --force
    
    # Step 9: Seed database
    Write-Host ""
    Write-Host "Step 9: Seeding database..." -ForegroundColor Green
    & $phpPath artisan db:seed --force
    
    Write-Host ""
    Write-Host "✓ Database setup complete!" -ForegroundColor Green
}
else {
    Write-Host ""
    Write-Host "⚠️  Skipping database setup. Run these commands manually:" -ForegroundColor Yellow
    Write-Host "  $phpPath artisan migrate" -ForegroundColor Cyan
    Write-Host "  $phpPath artisan db:seed" -ForegroundColor Cyan
}

# Step 10: Install Node dependencies
Write-Host ""
Write-Host "Step 10: Installing frontend dependencies..." -ForegroundColor Green
if (Get-Command npm -ErrorAction SilentlyContinue) {
    npm install
    Write-Host "✓ Node packages installed" -ForegroundColor Green
    
    Write-Host ""
    $buildAssets = Read-Host "Build frontend assets now? (Y/N)"
    if ($buildAssets -eq "Y" -or $buildAssets -eq "y") {
        npm run build
        Write-Host "✓ Assets built" -ForegroundColor Green
    }
}
else {
    Write-Host "⚠️  npm not found. Please install Node.js" -ForegroundColor Yellow
}

# Completion
Write-Host ""
Write-Host "=============================================" -ForegroundColor Cyan
Write-Host "🎉 Installation Complete!" -ForegroundColor Green
Write-Host "=============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "To start the application:" -ForegroundColor Yellow
Write-Host "  $phpPath artisan serve --host=127.0.0.1 --port=8000" -ForegroundColor Cyan
Write-Host ""
Write-Host "Then visit: http://localhost:8000" -ForegroundColor Green
Write-Host ""
Write-Host "For Vite dev server (hot reload):" -ForegroundColor Yellow
Write-Host "  npm run dev" -ForegroundColor Cyan

