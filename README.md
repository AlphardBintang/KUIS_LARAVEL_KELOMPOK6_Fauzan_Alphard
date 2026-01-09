# Sistem Manajemen Kost-Kostan

Aplikasi web berbasis Laravel untuk mengelola bisnis kost-kostan, membantu pemilik kost dalam mengelola data kamar, penyewa, kontrak sewa, dan pembayaran bulanan.

---

## Anggota Kelompok

**Kelompok 6:**
- **Fauzan Azhima | 105222003**
- **Alphard Alphard Bintang Ananditto | 105223014**

---

## Daftar Fitur yang Sudah Diimplementasi

### Fitur Utama (Wajib)

#### A. Dashboard/Halaman Utama
- Statistik total jumlah kamar
- Jumlah kamar terisi & tersedia
- Total pendapatan bulan ini
- Jumlah pembayaran tertunggak
- Chart/Grafik pendapatan 6 bulan terakhir
- Chart status pembayaran (lunas vs tertunggak)
- Chart distribusi tipe kamar (standard, deluxe, vip)

#### B. Manajemen Kamar (CRUD)
- **List Kamar** - Menampilkan semua kamar dengan pagination (10 per halaman)
- **Filter Kamar** - Filter berdasarkan tipe (standard, deluxe, vip) dan status (tersedia, terisi)
- **Tambah Kamar** - Form input data kamar baru dengan validasi
- **Edit Kamar** - Update informasi kamar
- **Hapus Kamar** - Hapus kamar (dengan validasi: tidak bisa dihapus jika memiliki riwayat sewa)
- Badge status kamar (tersedia/terisi)

#### C. Manajemen Penyewa (CRUD)
- **List Penyewa** - Menampilkan semua penyewa dengan pagination (10 per halaman)
- **Search Penyewa** - Pencarian berdasarkan nama lengkap atau nomor telepon
- **Tambah Penyewa** - Form registrasi penyewa baru dengan validasi
- **Detail Penyewa** - Lihat info lengkap penyewa beserta riwayat kontrak
- **Edit Penyewa** - Update data penyewa
- **Hapus Penyewa** - Hapus data penyewa (dengan validasi: tidak bisa dihapus jika memiliki kontrak aktif)

#### D. Manajemen Kontrak Sewa (CRUD)
- **List Kontrak** - Menampilkan semua kontrak dengan info penyewa & kamar
- **Buat Kontrak Baru** - Form pilih penyewa & kamar tersedia, set durasi kontrak
- **Detail Kontrak** - Lihat info kontrak lengkap + riwayat pembayaran
- **Edit Kontrak** - Update data kontrak sewa
- **Hapus Kontrak** - Hapus kontrak (otomatis mengembalikan status kamar ke tersedia jika kontrak aktif)
- **Auto Update Status Kamar** - Saat kontrak dibuat, status kamar otomatis menjadi "terisi"
- **Auto Update Status Kamar** - Saat kontrak selesai, status kamar otomatis menjadi "tersedia"

#### E. Manajemen Pembayaran (CRUD)
- **List Pembayaran** - Menampilkan riwayat pembayaran dengan relasi kontrak, penyewa, dan kamar
- **Catat Pembayaran** - Form input pembayaran untuk kontrak tertentu
- **Detail Pembayaran** - Lihat detail pembayaran lengkap
- **Edit Pembayaran** - Update data pembayaran
- **Hapus Pembayaran** - Hapus record pembayaran

### Fitur Bonus (Opsional)

#### 1. Search & Filter
- **Search Penyewa** - Pencarian penyewa berdasarkan nama lengkap atau nomor telepon
- **Filter Kamar** - Filter kamar berdasarkan tipe dan status

#### 2. Auto-generate Tagihan
- **Generate Tagihan Otomatis** - Sistem otomatis generate daftar pembayaran untuk semua kontrak aktif per bulan
- Mencegah duplikasi tagihan (tidak membuat tagihan jika sudah ada untuk bulan dan tahun yang sama)

#### 3. Export Laporan
- **Export ke Excel** - Export data pembayaran ke format Excel (.xlsx)
- **Export ke PDF** - Export data pembayaran ke format PDF dengan format laporan yang rapi

---

## Daftar Routes yang Tersedia

### Dashboard
| Method | Route | Controller | Method | Keterangan |
|--------|-------|------------|--------|------------|
| GET | `/` | DashboardController | index | Halaman dashboard utama dengan statistik |

### Kamar (Resource Routes)
| Method | Route | Controller | Method | Keterangan |
|--------|-------|------------|--------|------------|
| GET | `/kamar` | KamarController | index | List semua kamar (dengan filter) |
| GET | `/kamar/create` | KamarController | create | Form tambah kamar baru |
| POST | `/kamar` | KamarController | store | Simpan kamar baru |
| GET | `/kamar/{kamar}/edit` | KamarController | edit | Form edit kamar |
| PUT/PATCH | `/kamar/{kamar}` | KamarController | update | Update data kamar |
| DELETE | `/kamar/{kamar}` | KamarController | destroy | Hapus kamar |

### Penyewa (Resource Routes)
| Method | Route | Controller | Method | Keterangan |
|--------|-------|------------|--------|------------|
| GET | `/penyewa` | PenyewaController | index | List semua penyewa (dengan search) |
| GET | `/penyewa/create` | PenyewaController | create | Form tambah penyewa baru |
| POST | `/penyewa` | PenyewaController | store | Simpan penyewa baru |
| GET | `/penyewa/{penyewa}` | PenyewaController | show | Detail penyewa |
| GET | `/penyewa/{penyewa}/edit` | PenyewaController | edit | Form edit penyewa |
| PUT/PATCH | `/penyewa/{penyewa}` | PenyewaController | update | Update data penyewa |
| DELETE | `/penyewa/{penyewa}` | PenyewaController | destroy | Hapus penyewa |

### Kontrak Sewa (Resource Routes)
| Method | Route | Controller | Method | Keterangan |
|--------|-------|------------|--------|------------|
| GET | `/kontrak-sewa` | KontrakSewaController | index | List semua kontrak sewa |
| GET | `/kontrak-sewa/create` | KontrakSewaController | create | Form buat kontrak baru |
| POST | `/kontrak-sewa` | KontrakSewaController | store | Simpan kontrak baru |
| GET | `/kontrak-sewa/{kontrak_sewa}` | KontrakSewaController | show | Detail kontrak sewa |
| GET | `/kontrak-sewa/{kontrak_sewa}/edit` | KontrakSewaController | edit | Form edit kontrak |
| PUT/PATCH | `/kontrak-sewa/{kontrak_sewa}` | KontrakSewaController | update | Update kontrak sewa |
| DELETE | `/kontrak-sewa/{kontrak_sewa}` | KontrakSewaController | destroy | Hapus kontrak sewa |

### Pembayaran (Resource Routes)
| Method | Route | Controller | Method | Keterangan |
|--------|-------|------------|--------|------------|
| GET | `/pembayaran` | PembayaranController | index | List semua pembayaran |
| GET | `/pembayaran/create` | PembayaranController | create | Form catat pembayaran baru |
| POST | `/pembayaran` | PembayaranController | store | Simpan pembayaran baru |
| GET | `/pembayaran/{pembayaran}` | PembayaranController | show | Detail pembayaran |
| GET | `/pembayaran/{pembayaran}/edit` | PembayaranController | edit | Form edit pembayaran |
| PUT/PATCH | `/pembayaran/{pembayaran}` | PembayaranController | update | Update pembayaran |
| DELETE | `/pembayaran/{pembayaran}` | PembayaranController | destroy | Hapus pembayaran |

### Fitur Tambahan
| Method | Route | Controller | Method | Keterangan |
|--------|-------|------------|--------|------------|
| POST | `/generate-tagihan` | PembayaranController | generateTagihan | Generate tagihan otomatis untuk semua kontrak aktif |
| GET | `/export/pembayaran/excel` | ExportController | exportExcel | Export laporan pembayaran ke Excel |
| GET | `/export/pembayaran/pdf` | ExportController | exportPdf | Export laporan pembayaran ke PDF |

---

## Struktur Database

### Tabel `kamar`
- `id` (bigint, PK)
- `nomor_kamar` (string, unique)
- `tipe` (enum: standard, deluxe, vip)
- `harga_bulanan` (decimal)
- `fasilitas` (text)
- `status` (enum: tersedia, terisi)
- `timestamps`

### Tabel `penyewa`
- `id` (bigint, PK)
- `nama_lengkap` (string)
- `nomor_telepon` (string)
- `nomor_ktp` (string, unique)
- `alamat_asal` (text)
- `pekerjaan` (string)
- `timestamps`

### Tabel `kontrak_sewa`
- `id` (bigint, PK)
- `penyewa_id` (bigint, FK)
- `kamar_id` (bigint, FK)
- `tanggal_mulai` (date)
- `tanggal_selesai` (date)
- `harga_bulanan` (decimal)
- `status` (enum: aktif, selesai)
- `timestamps`

### Tabel `pembayaran`
- `id` (bigint, PK)
- `kontrak_sewa_id` (bigint, FK)
- `bulan` (integer, 1-12)
- `tahun` (integer)
- `jumlah_bayar` (decimal)
- `tanggal_bayar` (date)
- `status` (enum: lunas, tertunggak)
- `keterangan` (text, nullable)
- `timestamps`

---

## Cara Instalasi & Menjalankan

### Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- Database (SQLite/MySQL/PostgreSQL)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd KUIS_LARAVEL_KELOMPOK6_Fauzan_Alphard
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   - Edit file `.env` dan sesuaikan konfigurasi database
   - Atau gunakan SQLite (default)

5. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server**
   ```bash
   # Terminal 1: Laravel server
   php artisan serve
   
   # Terminal 2: Vite dev server (untuk Tailwind CSS)
   npm run dev
   ```

7. **Akses Aplikasi**
   - Buka browser: `http://localhost:8000`

---

## Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: SQLite (default)
- **Export Excel**: Maatwebsite Excel
- **Export PDF**: DomPDF (Barryvdh)

---

## Validasi yang Diimplementasi

### Kamar
- Nomor kamar harus unique
- Tipe harus: standard, deluxe, atau vip
- Harga bulanan harus angka positif

### Penyewa
- Nomor KTP harus unique
- Semua field wajib diisi
- Nomor telepon maksimal 15 karakter

### Kontrak Sewa
- Penyewa dan kamar harus valid (exists)
- Tanggal selesai harus lebih besar dari tanggal mulai
- Harga bulanan harus angka positif
- Status harus: aktif atau selesai

### Pembayaran
- Bulan harus antara 1-12
- Tahun harus 4 digit
- Jumlah bayar harus angka positif
- Tanggal bayar harus valid date

---

## Fitur Dashboard

Dashboard menampilkan:
- **Statistik Kamar**: Total, terisi, tersedia
- **Pendapatan Bulan Ini**: Total dari pembayaran bulan berjalan
- **Jumlah Tunggakan**: Pembayaran dengan status tertunggak
- **Chart Pendapatan**: Grafik pendapatan 6 bulan terakhir
- **Chart Status Pembayaran**: Perbandingan lunas vs tertunggak
- **Chart Tipe Kamar**: Distribusi kamar berdasarkan tipe

---

## Logika Bisnis yang Diimplementasi

1. **Kamar tidak bisa dihapus** jika memiliki riwayat kontrak sewa
2. **Penyewa tidak bisa dihapus** jika masih memiliki kontrak aktif
3. **Status kamar otomatis berubah** menjadi "terisi" saat kontrak dibuat
4. **Status kamar otomatis berubah** menjadi "tersedia" saat kontrak selesai atau dihapus
5. **Generate tagihan** hanya membuat tagihan untuk kontrak aktif
6. **Generate tagihan** mencegah duplikasi (cek bulan dan tahun)

---

## Dependencies

### PHP Packages
- `laravel/framework`: ^12.0
- `maatwebsite/excel`: Untuk export Excel
- `barryvdh/laravel-dompdf`: Untuk export PDF

### NPM Packages
- `tailwindcss`: Untuk styling
- `alpinejs`: Untuk interaktivitas (jika digunakan)

---

## License

Project ini dibuat untuk keperluan akademik (Kuis Praktikum Pemrograman Web).

---

**Dibuat oleh Kelompok 6**
