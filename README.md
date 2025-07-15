# SIM-Absensi

Sistem Informasi Manajemen Absensi Pegawai berbasis Web menggunakan **Laravel** + **AdminLTE**. Sistem ini memungkinkan pegawai melakukan absensi harian, pengajuan izin, serta pengelolaan data kepegawaian secara efisien.

## ✨ Fitur Utama

-   ✅ Manajemen Data Pegawai, Jabatan, dan User
-   🕒 Absensi Masuk & Pulang otomatis berdasarkan waktu dan user login
-   📝 Pengajuan Izin (izin, sakit, cuti) + approval oleh HRD/Admin
-   📊 Laporan Absensi & Kehadiran
-   🔐 Sistem Login Multi Role: Admin, HRD, Keuangan, Manager, Pegawai

## 🛠️ Instalasi

### 1. Clone Repositori

```bash
git clone https://github.com/Captzuzo/SIM-Absensi.git
cd sim-absensi
```

### 2. Install Dependency

```bash
composer install
npm install && npm run dev
```

### 3. Copy & Atur File .env

```bash
cp .env.example .env
php artisan key:generate
```

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi dan Seeder

```bash
php artisan migrate --seed
```

### 5. Jalankan Server

```bash
php artisan serve
```
