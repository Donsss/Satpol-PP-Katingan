# 🏛️ Satpol PP Website

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?style=for-the-badge&logo=php" alt="PHP">
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

- PHP >= 8.1
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
| `user@satpolpp.test` | `password` | User | Read Only |

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

#### **User**
- ✅ View content
- ❌ Create/Edit/Delete
- ❌ Admin panel access

---

## 📱 Screenshot

### 🏠 **Homepage**
![Homepage](docs/screenshots/homepage.png)

### 📰 **News Page**
![News](docs/screenshots/news.png)

### 🎛️ **Admin Dashboard**
![Dashboard](docs/screenshots/dashboard.png)

### 📱 **Mobile Responsive**
![Mobile](docs/screenshots/mobile.png)

---

## 🚀 Deployment

### 🌐 **Shared Hosting**

1. **Upload files** ke directory `public_html`
2. **Move public folder contents** ke root
3. **Update paths** di `index.php`
4. **Set environment** ke production
5. **Configure database** via cPanel

### ☁️ **VPS/Cloud Server**

```bash
# Clone to server
git clone https://github.com/username/satpol-pp.git /var/www/satpol-pp

# Install dependencies
cd /var/www/satpol-pp
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Set permissions
chown -R www-data:www-data /var/www/satpol-pp
chmod -R 755 /var/www/satpol-pp
chmod -R 775 /var/www/satpol-pp/storage
chmod -R 775 /var/www/satpol-pp/bootstrap/cache

# Setup environment
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 🐳 **Docker**

```yaml
# docker-compose.yml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8000:8000"
    environment:
      - DB_HOST=db
    depends_on:
      - db
  db:
    image: mysql:8.0
    environment:
      - MYSQL_DATABASE=satpol_pp
      - MYSQL_ROOT_PASSWORD=password
```

---

## 🤝 Kontribusi

Kami sangat welcome untuk kontribusi! 🎉

### 📝 **Cara Berkontribusi**

1. **Fork** repository ini
2. **Create branch** untuk fitur baru (`git checkout -b fitur-amazing`)
3. **Commit changes** (`git commit -m 'Add amazing feature'`)
4. **Push branch** (`git push origin fitur-amazing`)
5. **Create Pull Request**

### 🐛 **Melaporkan Bug**

Gunakan [GitHub Issues](https://github.com/username/satpol-pp/issues) dengan template:
- **Deskripsi bug**
- **Steps to reproduce**
- **Expected behavior**
- **Screenshots** (jika ada)
- **Environment info**

### 💡 **Request Fitur**

Silakan buat issue dengan label `enhancement` untuk request fitur baru.

---

## 📞 Support & Contact

- 📧 **Email:** admin@satpolpp.test
- 🐛 **Issues:** [GitHub Issues](https://github.com/username/satpol-pp/issues)
- 📖 **Documentation:** [Wiki](https://github.com/username/satpol-pp/wiki)

---

## 📄 Lisensi

Proyek ini dilisensikan under [MIT License](LICENSE).

```
MIT License

Copyright (c) 2025 Satpol PP

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

<div align="center">
  <h3>🚀 Built with ❤️ for Satpol PP</h3>
  <p>Made with Laravel • Bootstrap • Tailwind CSS</p>
  
  ⭐ **Jika project ini membantu, jangan lupa kasih star!** ⭐
</div>

---

**📅 Last Updated:** September 2025  
**👨‍💻 Maintainer:** [Your Name](https://github.com/username)
