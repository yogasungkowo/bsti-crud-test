# Dashboard Student - Setup Instructions

## Persiapan

Setelah login, user akan diarahkan ke dashboard profil siswa. Jika belum memiliki profil, akan diminta untuk membuat profil terlebih dahulu.

## Setup Storage untuk Upload Foto

Jalankan perintah berikut untuk membuat symbolic link storage:

```bash
php artisan storage:link
```

Perintah ini akan membuat link dari `public/storage` ke `storage/app/public`, sehingga foto profil yang diupload bisa diakses secara publik.

## Fitur Dashboard

### 1. **Halaman Profil (Dashboard)**
- Menampilkan informasi lengkap siswa
- Foto profil dengan fallback ke avatar default
- Informasi: Nama, NISN, Jenis Kelamin, Tanggal Lahir, Umur, Email, Alamat
- Tombol Edit dan Hapus Profil

### 2. **Halaman Edit Profil**
- Form lengkap untuk update data siswa
- Upload/update foto profil dengan preview
- Validasi data dengan Laravel Validation
- Support foto format: JPG, PNG, GIF (Max 2MB)

### 3. **Halaman Buat Profil**
- Untuk user baru yang belum memiliki profil
- Form pembuatan profil lengkap
- Upload foto profil (opsional)

## Routes

- `/dashboard` - Halaman profil siswa (index)
- `/profile/create` - Buat profil baru
- `/profile/{student}/edit` - Edit profil
- `/profile/{student}` - Update profil (PUT)
- `/profile/{student}` - Hapus profil (DELETE)

## Validasi

Semua form menggunakan Laravel validation dengan aturan:
- **Name**: Required, string, max 255 karakter
- **NISN**: Required, unique, max 255 karakter
- **Gender**: Required, enum (laki-laki/perempuan)
- **Email**: Required, valid email, unique
- **Date of Birth**: Required, valid date
- **Address**: Required, text
- **Profile Picture**: Optional, image (jpeg,png,jpg,gif), max 2MB

## Security

- Middleware auth melindungi semua routes
- User hanya bisa edit/delete profil sendiri
- Authorization check dengan user_id

## Design

- Gradient background modern (purple-blue)
- Card-based layout dengan shadow dan animasi
- Responsive design untuk mobile
- Smooth transitions dan hover effects
- Clean dan professional UI
