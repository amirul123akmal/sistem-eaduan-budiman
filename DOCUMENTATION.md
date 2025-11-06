# Sistem e-Aduan Kampung Budiman - Dokumentasi

## 📋 Ringkasan Sistem

Sistem e-Aduan Kampung Budiman adalah platform web untuk penduduk mengemukakan aduan kepada pentadbiran kampung tanpa perlu mendaftar. Sistem ini menggunakan Laravel 12 dengan Spatie Permission untuk kawalan akses dan Tailwind CSS + Flowbite untuk UI.

### Teknologi Utama
- **Framework**: Laravel 12
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Auth + Spatie Permission
- **Frontend**: Tailwind CSS v4 + Flowbite
- **Build Tool**: Vite

---

## 🗄️ Struktur Database & Migrations

### Urutan Migrations

Migrations dijalankan mengikut urutan berikut:

1. `0001_01_01_000000_create_users_table.php` - Tabel pengguna/admin
2. `0001_01_01_000001_create_cache_table.php` - Cache Laravel
3. `0001_01_01_000002_create_jobs_table.php` - Queue jobs
4. `2025_11_05_173419_create_permission_tables.php` - Spatie Permission tables
5. `2025_01_01_000003_create_complaint_types_table.php` - Jenis aduan
6. `2025_01_01_000004_create_complaints_table.php` - Aduan penduduk
7. `2025_01_01_000005_create_complaint_status_logs_table.php` - Log perubahan status
8. `2025_01_01_000006_create_settings_table.php` - Konfigurasi sistem
9. `2025_01_01_000007_add_additional_fields_to_users_table.php` - Tambah field users
10. `2025_01_01_000008_change_status_enum_to_bahasa_melayu.php` - Tukar status ke BM

### Tabel-tabel Database

#### 1. `users` - Pengguna Admin
Struktur untuk pentadbir sistem (Super Admin & Admin).

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | ID unik pengguna |
| `name` | VARCHAR(255) | Nama admin |
| `phone_number` | VARCHAR(20) | Nombor telefon |
| `email` | VARCHAR(255) UNIQUE | Email (untuk login) |
| `email_verified_at` | TIMESTAMP | Tarikh verifikasi email |
| `password` | VARCHAR(255) | Kata laluan (hashed) |
| `profile_picture` | VARCHAR(255) NULL | Gambar profil |
| `position` | VARCHAR(100) | Jawatan (Pengerusi, Setiausaha, AJK) |
| `remember_token` | VARCHAR(100) | Token remember me |
| `created_at` | TIMESTAMP | Tarikh cipta |
| `updated_at` | TIMESTAMP | Tarikh kemaskini |

**Relationships:**
- Has many `complaint_status_logs` (via `updated_by`)

#### 2. `complaint_types` - Jenis Aduan
Kategori aduan yang boleh dipilih oleh penduduk.

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | ID jenis aduan |
| `type_name` | VARCHAR(100) | Nama jenis (Prasarana, Kebersihan, etc) |
| `description` | TEXT NULL | Penerangan jenis aduan |
| `created_at` | TIMESTAMP | Tarikh cipta |
| `updated_at` | TIMESTAMP | Tarikh kemaskini |

**Default Data:**
1. Prasarana - Isu jalan, longkang, lampu jalan
2. Kebersihan - Isu sampah, perparitan
3. Keselamatan - Isu jenayah, pencahayaan
4. Lain-lain - Aduan umum

**Relationships:**
- Has many `complaints`

#### 3. `complaints` - Aduan Penduduk
Tabel utama untuk menyimpan semua aduan dari penduduk.

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | ID unik aduan |
| `name` | VARCHAR(100) | Nama pengadu |
| `phone_number` | VARCHAR(20) | Nombor telefon pengadu |
| `address` | TEXT | Alamat pengadu |
| `complaint_type_id` | BIGINT (FK) | Rujuk ke `complaint_types.id` |
| `description` | TEXT | Huraian aduan |
| `image_path` | VARCHAR(255) NULL | Lokasi gambar bukti |
| `status` | ENUM | Status: `menunggu`, `diterima`, `ditolak`, `selesai` (default: `menunggu`) |
| `admin_comment` | TEXT NULL | Ulasan dari admin |
| `created_at` | TIMESTAMP | Tarikh cipta |
| `updated_at` | TIMESTAMP | Tarikh kemaskini |

**Indexes:**
- `status`
- `complaint_type_id`
- `created_at`

**Relationships:**
- Belongs to `complaint_types`
- Has many `complaint_status_logs`

#### 4. `complaint_status_logs` - Audit Trail
Log setiap perubahan status aduan untuk audit trail.

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | ID log |
| `complaint_id` | BIGINT (FK) | Rujuk ke `complaints.id` |
| `status` | ENUM | Status: `menunggu`, `diterima`, `ditolak`, `selesai` |
| `updated_by` | BIGINT (FK) | Rujuk ke `users.id` (siapa yang ubah) |
| `comment` | TEXT NULL | Catatan ringkas |
| `created_at` | TIMESTAMP | Tarikh perubahan |

**Indexes:**
- `complaint_id`
- `updated_by`
- `created_at`

**Relationships:**
- Belongs to `complaints`
- Belongs to `users` (via `updated_by`)

#### 5. `settings` - Konfigurasi Sistem
Tabel untuk menyimpan konfigurasi umum sistem.

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | ID setting |
| `key` | VARCHAR(100) UNIQUE | Nama setting (contoh: `site_name`) |
| `value` | TEXT NULL | Nilai setting |
| `created_at` | TIMESTAMP | Tarikh cipta |
| `updated_at` | TIMESTAMP | Tarikh kemaskini |

**Indexes:**
- `key`

#### 6. Spatie Permission Tables
Tables yang dihasilkan secara automatik oleh package Spatie Permission:

- `roles` - Senarai peranan (Super Admin, Admin)
- `permissions` - Senarai keizinan individu
- `model_has_roles` - Hubungan pengguna-peranan
- `model_has_permissions` - Hubungan pengguna-izinan
- `role_has_permissions` - Hubungan peranan-izinan

---

## 🔗 Database Relationships

```
complaint_types (1) ──────< complaints (∞)
                                │
                                ├───< complaint_status_logs (∞)
                                │
users (1) ──────────────────────┘
```

### Relationship Details:

1. **complaint_types → complaints** (One to Many)
   - Foreign Key: `complaints.complaint_type_id` → `complaint_types.id`
   - On Delete: `RESTRICT` (tidak boleh delete jenis aduan jika masih ada aduan)

2. **complaints → complaint_status_logs** (One to Many)
   - Foreign Key: `complaint_status_logs.complaint_id` → `complaints.id`
   - On Delete: `CASCADE` (hapus log jika aduan dihapus)

3. **users → complaint_status_logs** (One to Many)
   - Foreign Key: `complaint_status_logs.updated_by` → `users.id`
   - On Delete: `RESTRICT` (tidak boleh delete user jika masih ada log)

---

## 🌱 Seeders

### Urutan Seeding

Seeder dijalankan mengikut urutan ini dalam `DatabaseSeeder`:

1. **RolePermissionSeeder** - Membuat roles dan permissions
2. **UserSeeder** - Membuat user Super Admin dan 2 Admin
3. **ComplaintTypeSeeder** - Membuat jenis aduan default

### 1. RolePermissionSeeder

Membuat sistem roles dan permissions menggunakan Spatie Permission.

**Roles yang dibuat:**
- **Super Admin**: Mempunyai semua permissions
- **Admin**: Hanya boleh:
  - View complaints
  - Update complaint status
  - View complaint types
  - View dashboard

**Permissions yang dibuat:**
- Complaints: `view complaints`, `create complaints`, `edit complaints`, `delete complaints`, `update complaint status`
- Complaint Types: `view complaint types`, `create complaint types`, `edit complaint types`, `delete complaint types`
- Users: `view users`, `create users`, `edit users`, `delete users`
- Settings: `view settings`, `edit settings`
- Dashboard: `view dashboard`

### 2. UserSeeder

Membuat 3 user default untuk sistem:

| Email | Password | Role | Position |
|-------|----------|------|----------|
| superadmin@budiman.com | password | Super Admin | Pengerusi |
| admin1@budiman.com | password | Admin | Setiausaha |
| admin2@budiman.com | password | Admin | AJK |

**⚠️ PENTING**: Tukar password di production!

### 3. ComplaintTypeSeeder

Membuat 4 jenis aduan default:

| ID | Type Name | Description |
|----|-----------|-------------|
| 1 | Prasarana | Isu jalan, longkang, lampu jalan |
| 2 | Kebersihan | Isu sampah, perparitan |
| 3 | Keselamatan | Isu jenayah, pencahayaan |
| 4 | Lain-lain | Aduan umum |

---

## 🔄 Flow Sistem

### 1. Flow Penduduk Membuat Aduan

```
1. Penduduk mengisi borang aduan (TANPA PERLU DAFTAR)
   ↓
2. Pilih jenis aduan (Prasarana, Kebersihan, Keselamatan, Lain-lain)
   ↓
3. Isi maklumat: nama, telefon, alamat, huraian
   ↓
4. Upload gambar bukti (optional)
   ↓
5. Submit aduan → Status: "menunggu"
   ↓
6. Disimpan dalam table `complaints`
```

### 2. Flow Admin Mengurus Aduan

```
1. Admin login ke sistem
   ↓
2. Lihat senarai aduan (status: menunggu)
   ↓
3. Admin boleh:
   - Lihat detail aduan
   - Update status: diterima / ditolak / selesai
   - Tambah komen admin
   ↓
4. Setiap perubahan status dicatat dalam `complaint_status_logs`
   - Record: complaint_id, status baru, updated_by, comment, timestamp
```

### 3. Status Aduan Flow

```
menunggu (default)
    ↓
    ├──→ diterima (Admin terima aduan)
    │       ↓
    │       └──→ selesai (Aduan selesai)
    │
    └──→ ditolak (Admin tolak aduan)
```

### 4. Authentication & Authorization Flow

```
1. User login dengan email & password
   ↓
2. Laravel Auth authenticate user
   ↓
3. Spatie Permission check role & permissions
   ↓
4. Access granted berdasarkan permissions:
   - Super Admin: Semua akses
   - Admin: Lihat & update aduan sahaja
```

---

## 📝 Cara Setup & Run

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` dengan database credentials.

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Run Seeders

```bash
php artisan db:seed
```

Atau seed individu:
```bash
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ComplaintTypeSeeder
```

### 5. Build Assets

```bash
npm run dev
# atau untuk production
npm run build
```

---

## 🔐 Default Credentials

Setelah run seeder, anda boleh login dengan:

**Super Admin:**
- Email: `superadmin@budiman.com`
- Password: `password`

**Admin 1:**
- Email: `admin1@budiman.com`
- Password: `password`

**Admin 2:**
- Email: `admin2@budiman.com`
- Password: `password`

---

## 📂 Struktur File Penting

```
app/
├── Models/
│   └── User.php (dengan HasRoles trait dari Spatie)

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

resources/
├── css/
│   └── app.css (Tailwind CSS + Flowbite)
└── js/
    └── app.js (Flowbite initialization)
```

---

## 🎨 Frontend Stack

- **Tailwind CSS v4**: Utility-first CSS framework
- **Flowbite**: Component library untuk Tailwind CSS
- **Vite**: Build tool untuk assets

Semua komponen Flowbite tersedia untuk digunakan dalam Blade templates.

---

## 📌 Nota Penting untuk Developer

1. **Status menggunakan Bahasa Melayu**: `menunggu`, `diterima`, `ditolak`, `selesai`
2. **Penduduk TIDAK perlu daftar**: Aduan boleh dibuat tanpa autentikasi
3. **Audit Trail**: Setiap perubahan status dicatat dalam `complaint_status_logs`
4. **Permissions**: Gunakan Spatie Permission untuk check akses:
   ```php
   $user->can('view complaints');
   $user->hasRole('Super Admin');
   ```
5. **Seeder menggunakan updateOrInsert**: Boleh dijalankan berulang kali tanpa duplicate

---

## 🚀 Next Steps untuk Development

1. Buat Models untuk `Complaint`, `ComplaintType`, `ComplaintStatusLog`
2. Buat Controllers untuk CRUD operations
3. Buat Routes dengan middleware untuk authentication
4. Buat Blade views dengan Flowbite components
5. Implement file upload untuk gambar aduan
6. Buat notification system untuk penduduk

---

**Dokumentasi terakhir dikemaskini**: 2025-01-01

