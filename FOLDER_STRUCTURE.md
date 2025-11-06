# Struktur Folder Komponen - Sistem e-Aduan Kampung Budiman

## 📁 Struktur Folder Views

```
resources/views/
├── layouts/                          # Layout templates (master layout)
│   ├── public.blade.php              # Layout untuk public user
│   └── admin.blade.php               # Layout untuk admin dashboard
│
├── components/                        # Reusable Blade components
│   ├── public/                       # Components untuk public pages
│   │   ├── header.blade.php
│   │   ├── footer.blade.php
│   │   ├── complaint-form.blade.php
│   │   └── ...
│   │
│   └── admin/                        # Components untuk admin pages
│       ├── sidebar.blade.php
│       ├── navbar.blade.php
│       ├── complaint-card.blade.php
│       ├── status-badge.blade.php
│       └── ...
│
├── public/                           # Halaman untuk public user (tanpa login)
│   ├── home.blade.php                # Halaman utama
│   ├── complaint/
│   │   ├── create.blade.php          # Borang buat aduan
│   │   ├── success.blade.php         # Mesej berjaya
│   │   └── track.blade.php           # Semak status aduan
│   └── ...
│
└── admin/                            # Halaman untuk admin (perlu login)
    ├── dashboard.blade.php            # Dashboard utama
    │
    ├── complaints/                    # Pengurusan aduan
    │   ├── index.blade.php           # Senarai aduan
    │   ├── show.blade.php            # Detail aduan
    │   ├── edit.blade.php            # Edit aduan
    │   └── filter.blade.php          # Component filter
    │
    ├── complaint-types/               # Pengurusan jenis aduan
    │   ├── index.blade.php           # Senarai jenis aduan
    │   ├── create.blade.php          # Tambah jenis aduan
    │   └── edit.blade.php            # Edit jenis aduan
    │
    ├── users/                         # Pengurusan admin/users
    │   ├── index.blade.php           # Senarai users
    │   ├── create.blade.php          # Tambah user
    │   ├── edit.blade.php            # Edit user
    │   └── profile.blade.php         # Profile user
    │
    └── settings/                      # Pengurusan settings
        ├── index.blade.php           # Senarai settings
        └── edit.blade.php            # Edit settings
```

## 📁 Struktur Folder Controllers

```
app/Http/Controllers/
├── Controller.php                    # Base controller
│
├── Public/                           # Controllers untuk public user
│   ├── HomeController.php
│   ├── ComplaintController.php
│   └── ...
│
└── Admin/                            # Controllers untuk admin
    ├── DashboardController.php
    │
    ├── Complaints/                    # Controllers untuk complaints
    │   ├── ComplaintController.php
    │   └── ComplaintStatusController.php
    │
    ├── ComplaintTypes/                # Controllers untuk complaint types
    │   └── ComplaintTypeController.php
    │
    ├── Users/                         # Controllers untuk users
    │   ├── UserController.php
    │   └── ProfileController.php
    │
    └── Settings/                      # Controllers untuk settings
        └── SettingController.php
```

## 📁 Struktur Folder Assets (JS & CSS)

```
resources/
├── js/
│   ├── app.js                        # Main JS entry point
│   ├── bootstrap.js                  # Bootstrap JS
│   │
│   ├── public/                       # JS untuk public pages
│   │   ├── complaint-form.js        # Form validation & submission
│   │   ├── complaint-track.js       # Track complaint status
│   │   └── ...
│   │
│   └── admin/                        # JS untuk admin pages
│       ├── dashboard.js             # Dashboard charts/stats
│       ├── complaint-management.js   # Complaint management functions
│       ├── filters.js                # Filter & search functions
│       └── ...
│
└── css/
    ├── app.css                       # Main CSS entry point
    │
    ├── public/                       # CSS untuk public pages
    │   ├── public.css                # Public-specific styles
    │   └── complaint-form.css        # Form styles
    │
    └── admin/                        # CSS untuk admin pages
        ├── admin.css                 # Admin dashboard styles
        ├── sidebar.css               # Sidebar styles
        └── tables.css                # Table styles
```

## 📋 Ringkasan Struktur

### Public User Area (Tanpa Login)
- **Views**: `resources/views/public/`
- **Components**: `resources/views/components/public/`
- **Controllers**: `app/Http/Controllers/Public/`
- **JS**: `resources/js/public/`
- **CSS**: `resources/css/public/`

### Admin Area (Perlu Login)
- **Views**: `resources/views/admin/`
- **Components**: `resources/views/components/admin/`
- **Controllers**: `app/Http/Controllers/Admin/`
- **JS**: `resources/js/admin/`
- **CSS**: `resources/css/admin/`

### Shared Resources
- **Layouts**: `resources/views/layouts/`
- **Main Assets**: `resources/js/app.js`, `resources/css/app.css`

## 🎯 Penggunaan

### Public User Pages
- **Home**: Landing page untuk penduduk
- **Buat Aduan**: Borang untuk penduduk membuat aduan
- **Semak Status**: Penduduk boleh semak status aduan dengan nombor rujukan

### Admin Pages
- **Dashboard**: Statistik dan overview aduan
- **Complaints**: Senarai, detail, dan kemas kini status aduan
- **Complaint Types**: Pengurusan jenis aduan (Super Admin sahaja)
- **Users**: Pengurusan admin users (Super Admin sahaja)
- **Settings**: Konfigurasi sistem (Super Admin sahaja)

## 📝 Nota

- Semua folder telah dibuat dan siap untuk development
- File `.blade.php` perlu dibuat mengikut keperluan
- Controllers perlu dibuat mengikut struktur folder
- JS dan CSS files boleh diimport dalam `app.js` dan `app.css` utama

