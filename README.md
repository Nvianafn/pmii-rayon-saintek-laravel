# Website Resmi PMII Rayon Sains & Teknologi 🚀

Website resmi **PMII (Pergerakan Mahasiswa Islam Indonesia) Rayon Sains dan Teknologi** sebagai wadah digitalisasi informasi, publikasi karya kader, dokumentasi kegiatan, serta pengelolaan administrasi kepengurusan secara terpusat.

---

## 🛠️ Tech Stack & Arsitektur

Aplikasi ini dibangun menggunakan ekosistem PHP modern dengan performa tinggi dan antarmuka yang dinamis:

*   **Framework Utama**: Laravel 11.x (PHP >= 8.2)
*   **Frontend Reaktivitas**: Livewire 3.x (SPA-like feel tanpa reload halaman)
*   **Styling & UI**: Tailwind CSS & AlpineJS (Responsive & Modern)
*   **Database**: MySQL / MariaDB
*   **Manajemen Gambar**: Intervention Image v3 (untuk konversi otomatis dan resize foto kegiatan/karya)

---

## ✨ Fitur Utama

### 🌐 Halaman Publik (Frontend)
1.  **Landing Page / Beranda**: Menampilkan visi misi singkat, infografis statistik rayon, profil biro, kegiatan terbaru, serta karya pilihan.
2.  **Tentang Kami**: Sejarah rayon, visi-misi lengkap, dan struktur kepengurusan aktif.
3.  **Daftar Biro**: Halaman informasi detail mengenai biro-biro yang ada beserta program kerja utamanya.
4.  **Kegiatan (Livewire)**: Direktori kegiatan rayon dengan fitur pencarian dan filter kategori biro secara real-time.
5.  **Ruang Karya (Livewire)**: Media publikasi artikel, esai, opini, berita, dan puisi yang ditulis langsung oleh kader.
6.  **Kontak**: Halaman untuk mengirimkan pesan atau masukan kepada pengurus.

### 🔐 Panel Administrasi (Backend)
Halaman admin dilindungi oleh autentikasi dan otorisasi berbasis Role (**Super Admin** & **Admin**):
1.  **Dashboard**: Ringkasan data statistik jumlah kader aktif, kegiatan, biro, dan karya.
2.  **Manajemen Anggota / Kader**: CRUD lengkap data profil fisik kader (NIM, Jurusan, Angkatan, Foto, Bio, dan Status).
3.  **Manajemen Kegiatan**: CRUD kegiatan lengkap dengan pengunggahan banyak foto sekaligus (*multiple image uploads*).
4.  **Manajemen Karya**: Verifikasi dan publikasi karya tulis kader.
5.  **Manajemen Kepengurusan & Biro**: Mengatur penugasan anggota ke jabatan BPH atau Biro pada periode tertentu.
6.  **Manajemen Periode**: Mengatur masa kepengurusan dan tema kepengurusan aktif.
7.  **Manajemen Pengguna (Khusus Super Admin)**: Membuat dan mengelola akun akses panel admin serta menautkannya dengan profil kader.
8.  **Pengaturan Web**: Manajemen identitas situs seperti Nama Rayon, Bio Singkat, Kontak WA, Alamat Sekretariat, dan Tautan Media Sosial.

---

## 💻 Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

### 1. Prasyarat (Prerequisites)
Pastikan komputer Anda sudah terinstal:
*   PHP >= 8.2 (dengan ekstensi `gd`, `intl`, `mbstring`, `zip`, `mysql`)
*   Composer
*   Node.js (LTS) & NPM
*   MySQL / MariaDB Server

### 2. Kloning Repositori
```bash
git clone git@github.com:Nvianafn/pmii-rayon-saintek-laravel.git
cd pmii-rayon-saintek-laravel
```

### 3. Instal Dependensi
```bash
# Dependensi PHP
composer install

# Dependensi Javascript/CSS
npm install
```

### 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka `.env` dan sesuaikan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_mysql_anda
DB_PASSWORD=password_mysql_anda
```

### 5. Generate Application Key & Link Storage
```bash
php artisan key:generate
php artisan storage:link
```

### 6. Migrasi & Seeding Database
Jalankan migrasi untuk membuat tabel beserta data dummy awal (admin default, periode, biro, anggota sampel):
```bash
php artisan migrate:fresh --seed
```

### 7. Jalankan Server Lokal
Jalankan server Laravel dan Vite (Tailwind compiler) di dua terminal terpisah:

**Terminal 1 (Laravel Server):**
```bash
php artisan serve
```

**Terminal 2 (Vite Development Server):**
```bash
npm run dev
```

Akses aplikasi di browser Anda melalui alamat `http://localhost:8000`.

### 🔑 Akun Admin Awal (Default Seeder)
*   **Halaman Login**: `http://localhost:8000/login`
*   **Email**: `admin@pmii-saintek.id`
*   **Password**: `password`
*   *(Harap langsung ganti password Anda melalui menu Pengguna di panel admin setelah login pertama kali!)*

---

## 🚀 Panduan Deployment (VPS)

Untuk panduan lengkap deployment menggunakan **Ubuntu FPM + Nginx + Let's Encrypt (SSL)** pada server VPS, silakan rujuk ke file **[DEPLOY.md](DEPLOY.md)**.

---

## 📄 Lisensi

Proyek ini bersifat open-source di bawah lisensi [MIT License](LICENSE).
