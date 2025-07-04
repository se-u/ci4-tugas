# CodeIgniter 4 - Aplikasi Toko Online

## Deskripsi Proyek

Aplikasi toko online berbasis CodeIgniter 4 dengan fitur lengkap untuk pengelolaan produk, transaksi, dan sistem diskon. Aplikasi ini dibangun menggunakan framework CodeIgniter 4 dengan database MySQL dan dilengkapi dengan API untuk integrasi sistem.

## Fitur Utama

### 1. **Manajemen Produk**
- CRUD produk (Create, Read, Update, Delete)
- Upload gambar produk
- Validasi input produk
- Pencarian dan filter produk

### 2. **Sistem Transaksi**
- Keranjang belanja (shopping cart)
- Proses checkout dengan validasi
- Penyimpanan detail transaksi
- Riwayat pembelian pengguna
- Integrasi dengan API pengiriman (RajaOngkir)

### 3. **Sistem Diskon**
- Manajemen diskon harian
- Validasi tanggal diskon unik
- Otomatis menampilkan diskon aktif hari ini
- Perhitungan diskon per item pada keranjang
- Badge notifikasi diskon di header

### 4. **Autentikasi & Otorisasi**
- Login/logout pengguna
- Validasi kredensial
- Session management
- Role-based access control

### 5. **API Integration**
- RESTful API untuk data transaksi
- API key authentication
- JSON response format
- Endpoint untuk mobile/external apps

### 6. **UI/UX**
- Bootstrap-based responsive design
- NiceAdmin template integration
- Interactive components
- Alert notifications
- Form validation feedback

## Instalasi

### Persyaratan Sistem
- PHP 8.1 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- Extensions: intl, mbstring, json, mysqlnd, libcurl

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd ci4-tugas
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   ```bash
   cp env .env
   ```
   Edit file `.env` dan sesuaikan konfigurasi:
   ```
   app.baseURL = 'http://localhost:8080'
   
   database.default.hostname = localhost
   database.default.database = ci4_tugas
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   
   # API Keys
   COST_KEY = your_rajaongkir_api_key
   ```

4. **Setup Database**
   ```bash
   # Buat database
   mysql -u root -p -e "CREATE DATABASE ci4_tugas"
   
   # Jalankan migrasi
   php spark migrate
   
   # Jalankan seeder
   php spark db:seed DiscountSeeder
   ```

5. **Jalankan Aplikasi**
   ```bash
   php spark serve
   ```
   Akses aplikasi di: `http://localhost:8080`

## Struktur Proyek

```
ci4-tugas/
├── app/
│   ├── Controllers/
│   │   ├── BaseController.php          # Base controller dengan session diskon
│   │   ├── Home.php                    # Homepage dan profil pengguna
│   │   ├── AuthController.php          # Autentikasi login/logout
│   │   ├── TransaksiController.php     # Keranjang & checkout
│   │   ├── DiskonController.php        # Manajemen diskon
│   │   └── ApiController.php           # API endpoints
│   ├── Models/
│   │   ├── ProductModel.php            # Model produk
│   │   ├── TransactionModel.php        # Model transaksi
│   │   ├── TransactionDetailModel.php  # Model detail transaksi
│   │   ├── DiscountModel.php           # Model diskon
│   │   └── UserModel.php               # Model pengguna
│   ├── Views/
│   │   ├── layout.php                  # Layout utama
│   │   ├── components/
│   │   │   ├── header.php              # Header dengan badge diskon
│   │   │   └── sidebar.php             # Sidebar navigasi
│   │   ├── v_home.php                  # Homepage
│   │   ├── v_keranjang.php             # Halaman keranjang
│   │   ├── v_checkout.php              # Halaman checkout
│   │   ├── v_diskon.php                # Halaman manajemen diskon
│   │   ├── v_profile.php               # Halaman profil pengguna
│   │   └── v_login.php                 # Halaman login
│   ├── Database/
│   │   ├── Migrations/
│   │   │   ├── 2025-05-09-032534_Product.php
│   │   │   ├── 2025-05-09-032546_Transaction.php
│   │   │   ├── 2025-05-09-032552_TransactionDetail.php
│   │   │   ├── 2025-05-09-032519_User.php
│   │   │   └── 2025-07-04-103545_Discount.php
│   │   └── Seeds/
│   │       └── DiscountSeeder.php      # Data sample diskon
│   ├── Config/
│   │   ├── Routes.php                  # Konfigurasi routing
│   │   └── Database.php                # Konfigurasi database
│   └── Helpers/
├── public/
│   ├── index.php                       # Entry point
│   ├── NiceAdmin/                      # Template assets
│   └── uploads/                        # Upload directory
├── writable/
│   ├── logs/                           # Log files
│   └── cache/                          # Cache files
├── .env                                # Environment configuration
├── composer.json                       # Composer dependencies
└── README.md                           # Dokumentasi proyek
```

## Fitur Database

### Tabel Utama
- **products**: Menyimpan data produk
- **transactions**: Menyimpan data transaksi
- **transaction_details**: Menyimpan detail item transaksi
- **discounts**: Menyimpan data diskon harian
- **users**: Menyimpan data pengguna

### Relasi Database
- Transaction → TransactionDetail (One to Many)
- Product → TransactionDetail (One to Many)
- User → Transaction (One to Many)

## API Documentation

### Endpoint Transaksi
**GET** `/api/transaction`
- **Headers**: `Key: your_api_key`
- **Response**: JSON dengan data transaksi dan detail

```json
{
  "status": {"code": 200, "description": "OK"},
  "results": [
    {
      "id": 1,
      "username": "user123",
      "total_harga": 100000,
      "details": [...]
    }
  ]
}
```

## Konfigurasi Tambahan

### Session Configuration
Session diskon otomatis di-set di `BaseController::initController()`:
```php
$discountModel = new \App\Models\DiscountModel();
$discount_today = $discountModel->where('tanggal', date('Y-m-d'))->first();
session()->set('discount_today', $discount_today);
```

### Validation Rules
- **Diskon**: Tanggal harus unik, tidak boleh duplikat
- **Transaksi**: Validasi item keranjang dan alamat pengiriman
- **Autentikasi**: Username minimal 6 karakter, password minimal 7 karakter numerik


### Database Connection
Pastikan konfigurasi database di `.env` sudah benar dan MySQL service berjalan.
