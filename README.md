# Sistem e-Aduan Kampung Budiman

Sistem pengurusan aduan untuk Kampung Budiman. Penduduk boleh membuat aduan tanpa perlu mendaftar, dan admin boleh mengurus aduan melalui dashboard.

## 🚀 Quick Start

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL/MariaDB

### Installation

```bash
# Clone repository
git clone <repository-url>
cd sistem-eaduan-budiman

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sistem_eaduan_budiman
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Build assets
npm run dev
```

### Default Login Credentials

**Super Admin:**
- Email: `superadmin@budiman.com`
- Password: `password`

**Admin:**
- Email: `admin1@budiman.com` / `admin2@budiman.com`
- Password: `password`

⚠️ **PENTING**: Tukar password di production!

## 📚 Dokumentasi

Untuk dokumentasi lengkap termasuk struktur database, relationships, dan flow sistem, sila rujuk **[DOCUMENTATION.md](./DOCUMENTATION.md)**

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Auth + Spatie Permission
- **Frontend**: Tailwind CSS v4 + Flowbite
- **Build Tool**: Vite

## 📋 Features

- ✅ Penduduk boleh membuat aduan tanpa perlu daftar
- ✅ Admin dashboard untuk mengurus aduan
- ✅ Role-based access control (Super Admin & Admin)
- ✅ Audit trail untuk perubahan status
- ✅ 4 jenis aduan default (Prasarana, Kebersihan, Keselamatan, Lain-lain)
- ✅ Status aduan dalam Bahasa Melayu

## 📁 Struktur Utama

```
app/
├── Models/
│   └── User.php

database/
├── migrations/
│   ├── 2025_01_01_000003_create_complaint_types_table.php
│   ├── 2025_01_01_000004_create_complaints_table.php
│   ├── 2025_01_01_000005_create_complaint_status_logs_table.php
│   └── ...
└── seeders/
    ├── DatabaseSeeder.php
    ├── RolePermissionSeeder.php
    ├── UserSeeder.php
    └── ComplaintTypeSeeder.php
```

## 🔄 Development Commands

```bash
# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=ComplaintTypeSeeder

# Build assets for development
npm run dev

# Build assets for production
npm run build

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 📝 License

Proprietary - Kampung Budiman

## 👥 Contributors

- Development Team

---

Untuk maklumat lanjut, sila rujuk [DOCUMENTATION.md](./DOCUMENTATION.md)
