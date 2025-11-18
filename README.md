# 🎓 BSTI Student Management System

Aplikasi manajemen data siswa berbasis Laravel 11 dengan fitur CRUD lengkap, autentikasi berbasis role (Admin & Student), dan integrasi DigitalOcean Spaces untuk penyimpanan file.

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Instalasi](#-instalasi)
- [Konfigurasi DigitalOcean Spaces](#-konfigurasi-digitalocean-spaces)
- [Kredensial Default](#-kredensial-default)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Struktur Database](#-struktur-database)
- [Endpoint & Routes](#-endpoint--routes)

---

## ✨ Fitur Utama

### 👨‍💼 Admin
- ✅ Dashboard dengan statistik lengkap
- ✅ Kelola data user (Create, Read, Update, Delete)
- ✅ Kelola data siswa dengan foto profil
- ✅ Upload foto profil ke DigitalOcean Spaces
- ✅ Assign role (Admin/Student) ke user
- ✅ Pagination & search functionality

### 👨‍🎓 Student
- ✅ Lihat profil pribadi
- ✅ Edit profil & upload foto
- ✅ Update informasi personal (NISN, tanggal lahir, alamat, dll)
- ✅ Dashboard siswa

### 🔐 Autentikasi
- ✅ Register & Login dengan validasi
- ✅ Password strength indicator
- ✅ Role-based access control (Spatie Permission)
- ✅ Password reveal/hide icon
- ✅ Email verification ready

---

## 🛠 Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Database**: MySQL
- **Authentication**: Laravel Breeze + Spatie Permission
- **Storage**: DigitalOcean Spaces (S3-compatible)
- **Frontend**: Blade Templates, Vanilla JavaScript
- **Validation**: Validator.js
- **Testing**: Pest PHP
- **Package Manager**: Composer, NPM

---

## 📥 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd Tes_crud_BSTI
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bsti_crud
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate & Seed Database

```bash
php artisan migrate:fresh --seed
```

---

## ☁️ Konfigurasi DigitalOcean Spaces

### 1. Buat DigitalOcean Spaces

1. Login ke [DigitalOcean](https://cloud.digitalocean.com)
2. Navigate ke **Spaces Object Storage**
3. Klik **Create Space**
4. Pilih region (contoh: Singapore - SGP1)
5. Beri nama space (contoh: `prasunk-storage`)
6. Pilih CDN: **Enable** (opsional)

### 2. Generate API Keys

1. Navigate ke **API** → **Tokens/Keys**
2. Klik **Generate New Key** di bagian **Spaces access keys**
3. Beri nama key (contoh: `Laravel-App`)
4. Simpan **Access Key** dan **Secret Key**

### 3. Konfigurasi .env

Tambahkan konfigurasi berikut di file `.env`:

```env
# DigitalOcean Spaces Configuration
SPACES_KEY=your_access_key_here
SPACES_SECRET=your_secret_key_here

AWS_ACCESS_KEY_ID=${SPACES_KEY}
AWS_SECRET_ACCESS_KEY=${SPACES_SECRET}
AWS_DEFAULT_REGION=sgp1
AWS_BUCKET=prasunk-storage
AWS_USE_PATH_STYLE_ENDPOINT=false
AWS_ENDPOINT=https://sgp1.digitaloceanspaces.com
AWS_URL=https://prasunk-storage.sgp1.digitaloceanspaces.com
```

**Catatan:**
- Ganti `sgp1` dengan region Spaces Anda
- Ganti `prasunk-storage` dengan nama Space Anda
- Format URL: `https://{bucket-name}.{region}.digitaloceanspaces.com`

### 4. Install AWS S3 Package

```bash
composer require league/flysystem-aws-s3-v3 "^3.0"
```

### 5. Clear Config Cache

```bash
php artisan config:clear
php artisan cache:clear
```

### 6. Test Upload

Upload foto profil melalui aplikasi. File akan tersimpan di:
```
https://prasunk-storage.sgp1.digitaloceanspaces.com/profile-pictures/
```

---

## 🔑 Kredensial Default

### Admin Accounts

#### Admin 1 (Main Admin)
```
Email: prayogasungkowo12@gmail.com
Password: Brimob12!
```

#### Admin 2
```
Email: admin@bsti.com
Password: password
```

### Student Accounts

Semua student menggunakan password yang sama:

```
Password: password
```

**Email Student:**
- prayoga.sungkowo@student.com
- siti.nurhaliza@student.com
- budi.santoso@student.com
- dewi.lestari@student.com
- eko.prasetyo@student.com
- fitri.handayani@student.com
- gilang.ramadhan@student.com
- hana.pertiwi@student.com
- indra.gunawan@student.com
- joko.widodo@student.com
- kartika.sari@student.com
- lukman.hakim@student.com
- maya.angelina@student.com
- nugroho.wibowo@student.com
- olivia.rahman@student.com

---

## 🚀 Menjalankan Aplikasi

### Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

### Build Assets

```bash
npm run dev
```

Atau untuk production:

```bash
npm run build
```

---

## 🗄 Struktur Database

### Tabel: `users`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | varchar | Nama lengkap user |
| email | varchar | Email (unique) |
| password | varchar | Hashed password |
| email_verified_at | timestamp | Email verification |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

### Tabel: `students`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke users |
| name | varchar | Nama siswa |
| nisn | varchar | NISN (unique, nullable) |
| email | varchar | Email siswa |
| gender | enum | male/female |
| date_of_birth | date | Tanggal lahir |
| address | text | Alamat lengkap |
| profile_picture | varchar | Path foto profil |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

### Tabel: `roles` & `permissions`
Menggunakan Spatie Laravel Permission dengan 2 role:
- **admin**: Full access ke semua fitur
- **student**: Akses terbatas ke profil sendiri

---

## 🛣 Endpoint & Routes

### Authentication
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman register
- `POST /register` - Proses register
- `POST /logout` - Logout

### Admin Routes (Middleware: auth, role:admin)
- `GET /admin/dashboard` - Dashboard admin
- `GET /admin/users` - Daftar user
- `POST /admin/users` - Tambah user
- `PUT /admin/users/{id}` - Update user
- `DELETE /admin/users/{id}` - Hapus user
- `GET /admin/students` - Daftar siswa
- `GET /admin/students/{id}` - Detail siswa
- `GET /admin/students/{id}/edit` - Form edit siswa
- `PUT /admin/students/{id}` - Update siswa
- `DELETE /admin/students/{id}` - Hapus siswa

### Student Routes (Middleware: auth, role:student)
- `GET /student` - Dashboard siswa
- `GET /student/edit` - Form edit profil
- `PUT /student` - Update profil
- `DELETE /student` - Hapus profil

---

## 📦 Package Dependencies

### PHP (Composer)
```json
{
    "laravel/framework": "^11.0",
    "spatie/laravel-permission": "^6.0",
    "league/flysystem-aws-s3-v3": "^3.0"
}
```

### JavaScript (NPM)
```json
{
    "validator": "^13.11.0",
    "vite": "^5.0"
}
```

---

## 📝 Catatan Penting

### ⚠️ Security Notice
**Aplikasi ini dibuat untuk keperluan latihan/pembelajaran.**

Untuk production:
1. ❌ **JANGAN** commit file `.env` ke repository
2. ✅ Gunakan password yang kuat
3. ✅ Enable email verification
4. ✅ Implement rate limiting
5. ✅ Enable HTTPS
6. ✅ Setup proper CORS di Spaces
7. ✅ Encrypt sensitive data

### 🔧 Troubleshooting

**Upload tidak berfungsi?**
```bash
# Pastikan package terinstall
composer require league/flysystem-aws-s3-v3

# Clear cache
php artisan config:clear
php artisan cache:clear

# Cek konfigurasi Spaces di .env
```

**Permission error?**
```bash
# Set permission folder storage
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Seeder error?**
```bash
# Fresh migrate dengan seed ulang
php artisan migrate:fresh --seed
```

---

## 👨‍💻 Developer

**Prayoga Sungkowo**
- Email: prayogasungkowo12@gmail.com
- Repository: [bsti-crud-test](https://github.com/yogasungkowo/bsti-crud-test)

---

## 📄 License

Project ini menggunakan [MIT license](https://opensource.org/licenses/MIT) untuk keperluan pembelajaran.

---

**Happy Coding! 🚀**

