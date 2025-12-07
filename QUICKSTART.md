# Quick Start Commands for Sanatan Scriptures

## Initial Setup (One-time)
```powershell
# 1. Copy to XAMPP
Copy-Item -Path "d:\Work\web\Sanatan-Scriptures" -Destination "D:\Apps\XAMPP\htdocs\sanatan-scriptures" -Recurse

# 2. Navigate to project
cd D:\Apps\XAMPP\htdocs\sanatan-scriptures

# 3. Install dependencies
composer install
npm install

# 4. Setup environment
Copy-Item .env.example .env
D:\Apps\XAMPP\php\php.exe artisan key:generate

# 5. Create database in phpMyAdmin: sanatan_scriptures

# 6. Run migrations and seeders
D:\Apps\XAMPP\php\php.exe artisan migrate
D:\Apps\XAMPP\php\php.exe artisan db:seed

# 7. Build assets
npm run build
```

## Daily Development Commands

### Start Application
```powershell
# Option 1: Laravel development server
cd D:\Apps\XAMPP\htdocs\sanatan-scriptures
D:\Apps\XAMPP\php\php.exe artisan serve --host=127.0.0.1 --port=8000

# Option 2: Use XAMPP Apache (already running)
# Just visit: http://localhost:8080/sanatan-scriptures/public
```

### Frontend Development (Hot Reload)
```powershell
# Terminal 1: Run Laravel server
D:\Apps\XAMPP\php\php.exe artisan serve

# Terminal 2: Run Vite dev server
npm run dev
```

### Database Commands
```powershell
# Fresh migration (⚠️ Deletes all data)
D:\Apps\XAMPP\php\php.exe artisan migrate:fresh --seed

# Run specific seeder
D:\Apps\XAMPP\php\php.exe artisan db:seed --class=VedaSeeder

# Check database connection
D:\Apps\XAMPP\php\php.exe artisan db:show
```

### Clear Cache
```powershell
D:\Apps\XAMPP\php\php.exe artisan cache:clear
D:\Apps\XAMPP\php\php.exe artisan config:clear
D:\Apps\XAMPP\php\php.exe artisan view:clear
D:\Apps\XAMPP\php\php.exe artisan route:clear
```

## Useful URLs

- **Application**: http://localhost:8000
- **phpMyAdmin**: http://localhost/phpmyadmin
- **XAMPP Control**: Launch from D:\Apps\XAMPP\xampp-control.exe

## Keyboard Shortcuts (in app)

- `Alt + D` - Dashboard
- `Alt + V` - Vedas
- `Alt + L` - Leaderboard

## Troubleshooting

### Port 8000 already in use
```powershell
# Find and kill process
netstat -ano | findstr :8000
taskkill /PID <PID> /F

# Or use different port
D:\Apps\XAMPP\php\php.exe artisan serve --port=8001
```

### Assets not loading
```powershell
npm run build
D:\Apps\XAMPP\php\php.exe artisan cache:clear
```

### MySQL connection error
1. Start MySQL in XAMPP Control Panel
2. Check .env database credentials
3. Verify database exists in phpMyAdmin
