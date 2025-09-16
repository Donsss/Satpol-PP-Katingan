# 🏛️ Satpol PP Website

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-12.23.1-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3.24-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Tailwind-3.x-cyan?style=for-the-badge&logo=tailwindcss" alt="Tailwind">
</div>

<div align="center">
  <h3>🚀 Sistem Manajemen Konten Website Satpol PP</h3>
  <p>Platform manajemen konten berbasis Laravel untuk Satuan Polisi Pamong Praja dengan fitur lengkap dan desain responsif modern.</p>
</div>

---

## 📋 Daftar Isi

- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Teknologi](#️-teknologi)
- [⚡ Quick Start](#-quick-start)
- [📦 Instalasi Detail](#-instalasi-detail)
- [🏗️ Struktur Project](#️-struktur-project)
- [🔐 Autentikasi & Role](#-autentikasi--role)
- [📱 Screenshot](#-screenshot)
- [🚀 Deployment](#-deployment)
- [🤝 Kontribusi](#-kontribusi)
- [📄 Lisensi](#-lisensi)

---

## ✨ Fitur Utama

### 📰 **Manajemen Berita**
- ✅ CRUD berita dengan editor WYSIWYG
- 📸 Upload thumbnail otomatis
- 🔍 Pencarian dan filter berita
- 📱 Tampilan responsif untuk mobile
- 📊 Status publikasi (draft/published)

### 🖼️ **Galeri Foto & Album**
- 📁 Manajemen album foto
- 🖼️ Upload multiple foto
- 🔍 Zoom fullscreen
- 🎨 Lazy loading untuk performa optimal

### 📄 **Manajemen Dokumen**
- 📋 CRUD dokumen (PDF, DOC, XLS, dll)
- ⬇️ Download tracking
- 🔐 Access control per dokumen
- 📊 Statistik download

### 🏢 **Struktur Organisasi**
- 🌳 Tampilan hierarchical tree
- 👥 Manajemen anggota organisasi
- 📸 Upload foto profil anggota
- 🔄 Drag & drop reorder

### 📋 **Manajemen Profil Instansi**
- 📖 Sejarah instansi
- 🎯 Visi & Misi
- ⚖️ Tugas & Fungsi
- 🏛️ Profil lengkap organisasi

### 🎛️ **Dashboard Admin**
- 📊 Statistik konten
- 📈 Analytics dashboard
- 🔔 Notifikasi sistem
- ⚙️ Pengaturan website

### 👥 **User Management**
- 🔐 Role-based access (Super Admin, Admin, User)
- 👤 Profil pengguna
- 🔑 Password management
- 📝 Activity logging

---

## 🛠️ Teknologi

### Backend
- **Laravel 10.x** - PHP Framework
- **MySQL/SQLite** - Database
- **Laravel Sanctum** - API Authentication
- **Spatie Permission** - Role & Permission
- **Laravel Swagger** - API Documentation

### Frontend
- **Blade Templates** - Template Engine
- **Bootstrap 5.3** - UI Framework
- **Tailwind CSS 3.x** - Utility CSS
- **Alpine.js** - JavaScript Framework
- **FontAwesome 6** - Icons
- **SweetAlert2** - Modal & Alerts

### Tools & Utilities
- **Vite** - Asset Bundling
- **Composer** - PHP Package Manager
- **NPM** - Node Package Manager
- **Git** - Version Control

---

## ⚡ Quick Start

```bash
# Clone repository
git clone https://github.com/username/satpol-pp.git
cd satpol-pp

# Install dependencies
composer install && npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --seed

# Build assets & run
npm run build
php artisan serve
```

🎉 **Website akan berjalan di:** `http://localhost:8000`

---

## 📦 Instalasi Detail

### 📋 Prerequisites

- PHP = 8.3.24
- Composer
- Node.js & NPM
- MySQL/MariaDB atau SQLite
- Web server (Apache/Nginx) untuk production

### 🔧 Langkah Instalasi

#### 1️⃣ **Clone & Setup Project**
```bash
git clone https://github.com/username/satpol-pp.git
cd satpol-pp
```

#### 2️⃣ **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

#### 3️⃣ **Environment Configuration**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4️⃣ **Database Configuration**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=satpol_pp
DB_USERNAME=root
DB_PASSWORD=
```

#### 5️⃣ **Database Migration & Seeding**
```bash
# Create database tables
php artisan migrate

# Seed with sample data (optional)
php artisan db:seed
```

#### 6️⃣ **Storage Setup**
```bash
# Create symbolic link for storage
php artisan storage:link

# Set permissions (Linux/Mac)
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

#### 7️⃣ **Build Assets**
```bash
# Development
npm run dev

# Production
npm run build
```

#### 8️⃣ **Run Application**
```bash
# Development server
php artisan serve

# With custom host/port
php artisan serve --host=0.0.0.0 --port=8080
```

---

## 🏗️ Struktur Project

```
satpol-pp/
├── 📁 app/
│   ├── 📁 Http/Controllers/     # Controllers
│   ├── 📁 Models/              # Eloquent Models
│   ├── 📁 Policies/            # Authorization Policies
│   └── 📁 Traits/              # Reusable Traits
├── 📁 config/                  # Configuration Files
├── 📁 database/
│   ├── 📁 migrations/          # Database Migrations
│   └── 📁 seeders/             # Database Seeders
├── 📁 public/                  # Public Assets
├── 📁 resources/
│   ├── 📁 css/                 # Stylesheets
│   ├── 📁 js/                  # JavaScript Files
│   └── 📁 views/               # Blade Templates
│       ├── 📁 berita/          # News Templates
│       ├── 📁 albums/          # Album Templates
│       ├── 📁 documents/       # Document Templates
│       ├── 📁 layouts/         # Layout Templates
│       └── 📁 user-views/      # Public User Views
├── 📁 routes/                  # Route Definitions
├── 📁 storage/                 # File Storage
└── 📄 README.md               # This file
```

---

## 🔐 Autentikasi & Role

### 👤 Default Users
Setelah seeding, tersedia user berikut:

| Email | Password | Role | Akses |
|-------|----------|------|-------|
| `admin@satpolpp.test` | `password` | Super Admin | Full Access |
| `editor@satpolpp.test` | `password` | Admin | Content Management |

### 🔑 Permissions

#### **Super Admin**
- ✅ Full system access
- ✅ User management
- ✅ System settings
- ✅ All content CRUD

#### **Admin**
- ✅ Content management
- ✅ Media upload
- ❌ User management
- ❌ System settings

---


<div align="center">
  <h3>🚀 Built with ❤️ for Satpol PP</h3>
  <p>Made with Laravel • Bootstrap • Tailwind CSS</p>
</div>

---

**📅 Last Updated:** September 2025  
