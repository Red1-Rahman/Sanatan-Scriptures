# Sanatan Scriptures

A Laravel web application for studying ancient Sanskrit manuscripts including the Vedas, Mahabharata (with Bhagavad Gita), and Puranas. Built with a focus on academic research and learning, featuring gamification elements for progress tracking.

## 📖 About

Sanatan Scriptures is an educational platform for studying ancient Sanatan/Hindu texts with:

- **Multi-Scripture Library**: Vedas, Mahabharata, Bhagavad Gita, Puranas
- **Progress Tracking**: Mark verses as read, understood, or memorized
- **Gamification**: Earn points, maintain streaks, unlock achievements
- **JSON-Based Content**: Easy-to-maintain manuscript data in JSON format
- **Responsive Design**: Beautiful UI with dark mode support
- **Multi-language Support**: Sanskrit (Devanagari), Transliteration (IAST), English

### Currently Available Scriptures

#### Vedas (वेद)

- **Rig Veda** (ऋग्वेद) - 10 Mandalas, 10,552 verses
- **Sama Veda** (सामवेद) - 2 Mandalas, 1,875 verses
- **Yajur Veda** (यजुर्वेद) - 40 Mandalas, 1,975 verses
- **Atharva Veda** (अथर्ववेद) - 20 Mandalas, 5,977 verses

#### Mahabharata (महाभारत)

- **Adi Parva** (आदिपर्व) - 225 chapters, 7,984 verses
- **Bhishma Parva** (भीष्मपर्व) - 124 chapters, 5,884 verses
  - Contains the **Bhagavad Gita** (700 verses, 18 chapters)

#### Puranas (पुराण)

- **Brahma Purana** (ब्रह्मपुराण) - 246 chapters, 13,000 verses
- **Vishnu Purana** (विष्णुपुराण) - 126 chapters, 7,000 verses
- **Shiva Purana** (शिवपुराण) - 100 chapters, 24,000 verses

_Note: Sample data included - Rig Veda Mandala 1 Sukta 1 (9 verses) and Bhagavad Gita Chapter 1 (first 10 verses)._

## 🚀 Technical Stack

- **Framework**: Laravel 10.x (PHP 8.2+)
- **Database**: MySQL 8.0+
- **Frontend**: Blade Templates, Tailwind CSS 3.x, Alpine.js
- **Build Tool**: Vite 5.x
- **Fonts**: Noto Sans Devanagari, Noto Serif, Inter
- **Server**: XAMPP (Apache + MySQL) or Laravel Artisan

## 🎨 Design Philosophy

This application is developed with a **scholarly and academic focus**:

- ✅ Educational content presentation (manuscripts as historical/literary texts)
- ✅ Sanskrit preservation and transliteration accuracy
- ✅ JSON-based content for easy community contribution
- ✅ Clean, minimal UI focusing on readability
- ❌ No religious imagery or worship elements
- ❌ Pure academic and research-oriented approach

## 🎯 Features

### For Users

- ✅ **Progress Tracking**: Mark verses as read, understood, or memorized
- 🔥 **Streak System**: Build daily reading habits with streak tracking
- ⭐ **Points & Levels**: Earn points for every milestone
- 🏆 **Achievements**: Unlock badges for various accomplishments
- 📊 **Statistics**: View detailed progress by Veda
- 🎯 **Daily Goals**: Set and track daily verse reading targets
- 🌙 **Dark Mode**: Toggle between light and dark themes
- 🌐 **Multi-language**: Sanskrit (Devanagari), Transliteration (IAST), English, Hindi

### Gamification System

**Points:**

- Mark as Read: +1 point
- Mark as Understood: +3 points
- Mark as Memorized: +5 points
- 7-day streak bonus: +10 points
- 30-day streak bonus: +50 points
- Complete one Veda: +100 points
- Complete one Purana: +80 points
- Complete one Parva: +80 points
- Complete all 4 Vedas: +500 points

**Achievements:**

- 📖 First Veda Complete (+100 pts)
- 📖 First Purana Complete (+80 pts)
- 📖 First Parva Complete (+80 pts)
- 💯 100 Verses Read (+50 pts)
- 🏆 1000 Verses Read (+200 pts)
- 🔥 7 Day Streak (+25 pts)
- 🔥🔥 30 Day Streak (+100 pts)
- 🔥🔥🔥 100 Day Streak (+300 pts)
- ⭐ All Vedas Complete (+500 pts)
- 🧠 500 Memorized (+250 pts)

## 📋 Prerequisites

Before installation, ensure you have:

- **XAMPP** installed at `D:/Apps/XAMPP`
  - Apache HTTP Server (Port 8080)
  - MySQL Server (Port 3306)
  - PHP 8.2 or higher
- **Composer** (PHP dependency manager)
- **Node.js** 18+ and npm (for frontend assets)
- **Git** (optional, for version control)

## 🔧 Installation Steps

### 1. Copy Project to XAMPP

```powershell
# Copy the entire project folder to XAMPP's htdocs
Copy-Item -Path "d:\Work\web\Sanatan-Scriptures" -Destination "D:\Apps\XAMPP\htdocs\sanatan-scriptures" -Recurse
cd D:\Apps\XAMPP\htdocs\sanatan-scriptures
```

### 2. Install PHP Dependencies

```powershell
composer install
```

### 3. Environment Configuration

```powershell
# Copy environment file
Copy-Item .env.example .env

# Generate application key
D:\Apps\XAMPP\php\php.exe artisan key:generate
```

### 4. Configure Environment Variables

Open `.env` file and ensure these settings:

```env
APP_NAME="Sanatan Scriptures"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanatan_scriptures
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click "New" in the left sidebar
3. Database name: `sanatan_scriptures`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

### 6. Run Migrations & Seeders

```powershell
# Run database migrations
D:\Apps\XAMPP\php\php.exe artisan migrate

# Seed the database with all scripture data
D:\Apps\XAMPP\php\php.exe artisan db:seed
```

This will create:

- **Vedas**: All 4 Vedas metadata + Rig Veda Mandala 1, Sukta 1 (9 verses)
- **Mahabharata**: 2 Parvas (Adi Parva, Bhishma Parva)
- **Bhagavad Gita**: Chapter 1 (first 10 verses)
- **Puranas**: 3 Puranas (Brahma, Vishnu, Shiva) - ready for content

### 7. Install Frontend Dependencies

```powershell
# Install Node.js packages
npm install

# Build assets for development
npm run dev

# OR build for production
npm run build
```

### 8. Start the Application

#### Option A: Using Laravel's Built-in Server

```powershell
D:\Apps\XAMPP\php\php.exe artisan serve --host=127.0.0.1 --port=8000
```

Access at: `http://localhost:8000`

#### Option B: Using XAMPP Apache

1. Ensure Apache is running in XAMPP Control Panel
2. Access at: `http://localhost:8080/sanatan-scriptures/public`

**For cleaner URLs**, configure a virtual host:

Create `D:\Apps\XAMPP\apache\conf\extra\httpd-vhosts.conf`:

```apache
<VirtualHost *:8080>
    DocumentRoot "D:/Apps/XAMPP/htdocs/sanatan-scriptures/public"
    ServerName sanatan.local

    <Directory "D:/Apps/XAMPP/htdocs/sanatan-scriptures/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Add to `C:\Windows\System32\drivers\etc\hosts`:

```
127.0.0.1 sanatan.local
```

Access at: `http://sanatan.local:8080`

## 🗂️ Database Structure

### Tables

1. **vedas** - Metadata for the 4 Vedas
2. **verses** - Individual hymns/shlokas with Sanskrit, transliteration, translations
3. **users** - User accounts with gamification fields
4. **user_verse_progress** - Track read/understood/memorized status per verse
5. **daily_goals** - Daily reading targets
6. **achievements** - Unlocked achievement badges

### Key Relationships

```
Veda → hasMany → Verses
User → hasMany → UserVerseProgress
User → hasMany → Achievements
User → hasMany → DailyGoals
Verse → hasMany → UserVerseProgress
```

## 📁 Project Structure

```
sanatan-scriptures/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── VedaController.php
│   │   ├── MahabharataController.php
│   │   ├── PuranaController.php
│   │   ├── ProgressController.php
│   │   ├── DashboardController.php
│   │   ├── AchievementController.php
│   │   └── LeaderboardController.php
│   └── Models/
│       ├── Veda.php
│       ├── Verse.php
│       ├── MahabharataParva.php
│       ├── BhagavadGitaVerse.php
│       ├── Purana.php
│       ├── User.php
│       ├── UserVerseProgress.php
│       ├── DailyGoal.php
│       └── Achievement.php
├── database/
│   ├── data/                           # 📁 JSON content files
│   │   ├── vedas.json
│   │   ├── rig_veda_mandala_1_sukta_1.json
│   │   ├── mahabharata_parvas.json
│   │   ├── bhagavad_gita_sample.json
│   │   ├── puranas.json
│   │   ├── brahma_purana_content.json
│   │   ├── vishnu_purana_content.json
│   │   └── shiva_purana_content.json
│   ├── migrations/
│   │   ├── *_create_vedas_table.php
│   │   ├── *_create_verses_table.php
│   │   ├── *_create_mahabharata_parvas_table.php
│   │   ├── *_create_bhagavad_gita_verses_table.php
│   │   ├── *_create_puranas_table.php
│   │   ├── *_create_users_table.php
│   │   ├── *_create_user_verse_progress_table.php
│   │   ├── *_create_daily_goals_table.php
│   │   └── *_create_achievements_table.php
│   └── seeders/
│       ├── VedaSeeder.php
│       ├── RigVedaSampleSeeder.php
│       ├── MahabharataParvaSeeder.php
│       ├── BhagavadGitaSeeder.php
│       └── PuranaSeeder.php
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── vedas/
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── mandala.blade.php
│   │   ├── mahabharata/
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   ├── bhagavad-gita.blade.php
│   │   │   └── chapter.blade.php
│   │   ├── puranas/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── progress/
│   │   ├── achievements/
│   │   └── leaderboard/
│   ├── css/app.css
│   └── js/app.js
└── routes/web.php
```

## 🎨 Design & Styling

### Color Palette

- **Saffron**: `#FF9933` - Primary accent
- **White**: `#FFFFFF`
- **Green**: `#138808` - Success states
- **Navy**: `#000080` - Alternative accent

### Typography

- **Sanskrit Text**: Noto Sans Devanagari (24-28px)
- **Transliteration**: Noto Serif (italic)
- **English Text**: Inter, system-ui

### Features

- Responsive design (mobile-first)
- Dark mode support
- Smooth animations
- Toast notifications
- Progress bars with gradients

## 🔌 API Endpoints (AJAX)

```javascript
POST / verse / { id } / mark - read; // Mark verse as read (+1 pt)
POST / verse / { id } / mark - understood; // Mark as understood (+3 pts)
POST / verse / { id } / mark - memorized; // Mark as memorized (+5 pts)
```

All endpoints return JSON:

```json
{
  "success": true,
  "message": "Verse marked as read!",
  "points_earned": 1,
  "total_points": 42,
  "current_streak": 7
}
```

## 🚀 Extending the Application

### Adding More Content via JSON Files

The easiest way to add content is by editing JSON files in `database/data/`:

**For Vedas:**

```json
// database/data/sama_veda_content.json
[
  {
    "veda_number": 2,
    "mandala_number": 1,
    "sukta_number": 1,
    "verse_number": 1,
    "sanskrit_text": "...",
    "transliteration": "...",
    "translation_english": "..."
  }
]
```

**For Bhagavad Gita:**

```json
// database/data/bhagavad_gita_chapter_2.json
[
  {
    "parva_number": 6,
    "chapter": 2,
    "verse": 1,
    "text_sanskrit": "...",
    "text_transliteration": "...",
    "text_english": "...",
    "speaker": "...",
    "chapter_name": "...",
    "chapter_name_sanskrit": "..."
  }
]
```

**For Puranas:**

```json
// database/data/brahma_purana_content.json
[
  {
    "purana_number": 1,
    "chapter": 1,
    "verse": 1,
    "sanskrit_text": "...",
    "transliteration": "...",
    "translation_english": "..."
  }
]
```

After editing JSON files:

```powershell
# Re-seed the database
D:\Apps\XAMPP\php\php.exe artisan migrate:fresh --seed
```

### Adding New Scripture Types

To add new categories (e.g., Upanishads):

1. **Create JSON file**: `database/data/upanishads.json`
2. **Create migration**: `*_create_upanishads_table.php`
3. **Create model**: `app/Models/Upanishad.php`
4. **Create controller**: `app/Http/Controllers/UpanishadController.php`
5. **Create seeder**: `database/seeders/UpanishadSeeder.php`
6. **Add routes**: `routes/web.php`
7. **Create views**: `resources/views/upanishads/`

## 🧪 Testing

```powershell
# Run PHP unit tests
D:\Apps\XAMPP\php\php.exe artisan test

# Run specific test
D:\Apps\XAMPP\php\php.exe artisan test --filter=VedaTest
```

## 🐛 Troubleshooting

### Port Already in Use

```powershell
# Find process using port 8000
netstat -ano | findstr :8000

# Kill the process
taskkill /PID <process_id> /F

# Use different port
D:\Apps\XAMPP\php\php.exe artisan serve --port=8001
```

### MySQL Connection Error

- Ensure MySQL is running in XAMPP Control Panel
- Check database credentials in `.env`
- Verify database exists in phpMyAdmin

### Assets Not Loading

```powershell
# Clear cache
D:\Apps\XAMPP\php\php.exe artisan cache:clear
D:\Apps\XAMPP\php\php.exe artisan config:clear
D:\Apps\XAMPP\php\php.exe artisan view:clear

# Rebuild assets
npm run build
```

### Permission Issues

```powershell
# Set proper permissions (Windows)
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T
```

## 📝 Development Commands

```powershell
# Create new migration
D:\Apps\XAMPP\php\php.exe artisan make:migration create_table_name

# Create new model with migration
D:\Apps\XAMPP\php\php.exe artisan make:model ModelName -m

# Create new controller
D:\Apps\XAMPP\php\php.exe artisan make:controller ControllerName

# Create new seeder
D:\Apps\XAMPP\php\php.exe artisan make:seeder SeederName

# Fresh migration (WARNING: Deletes all data)
D:\Apps\XAMPP\php\php.exe artisan migrate:fresh --seed

# Watch for file changes (Vite)
npm run dev
```

## 🤝 Contributing

To contribute additional content to any scripture:

1. **Find the appropriate JSON file** in `database/data/`
2. **Add verses** following the existing structure:
   - Ensure proper Sanskrit (Devanagari) encoding
   - Include transliteration (IAST standard)
   - Provide English translation
   - Add relevant metadata (speaker, chapter name, etc.)
3. **Test locally**:
   ```powershell
   D:\Apps\XAMPP\php\php.exe artisan migrate:fresh --seed
   D:\Apps\XAMPP\php\php.exe artisan serve
   ```
4. **Submit pull request** with clear description of added content

**Content Guidelines:**

- Maintain academic/scholarly focus
- Use authoritative Sanskrit sources
- Provide accurate translations
- Include proper verse numbering
- Preserve original formatting and diacritical marks

## 📜 License

This project is open-source and available for educational and research purposes.

## 🙏 Acknowledgments

- Sanskrit texts sourced from authentic repositories
- Translations based on scholarly interpretations
- Built with academic respect for ancient manuscripts
- Developed with focus on historical and spiritual study

## 📞 Support

For issues or questions:

1. Check the troubleshooting section
2. Review Laravel documentation: https://laravel.com/docs
3. Review Tailwind CSS documentation: https://tailwindcss.com

---
