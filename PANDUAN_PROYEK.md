# 📚 Panduan Proyek MiesoAuction

## 🗂️ Penjelasan Struktur Folder

Proyek ini menggunakan **MVC (Model-View-Controller)** pattern. Berikut penjelasan setiap folder:

### 📁 Struktur Utama

```
MiesoAuction/
├── public/              # Folder yang diakses oleh browser (entry point)
│   ├── index.php        # Router utama - semua request masuk ke sini
│   └── assets/          # CSS, JS, gambar, font
│       ├── style/       # File CSS
│       ├── js/          # File JavaScript
│       └── img/          # Gambar
│
├── app/                 # Kode aplikasi utama
│   ├── controllers/     # Controller - menangani logic & request
│   ├── models/          # Model - berinteraksi dengan database
│   ├── Views/           # View - tampilan HTML/PHP
│   ├── core/            # Core classes (Controller, DbConnection)
│   └── helpers/         # Helper functions (Auth, Session, Upload)
│
├── config/              # Konfigurasi (database, base URL)
├── routes/              # Definisi routing (web.php)
└── PANDUAN_PROYEK.md   # File ini
```

### 🔍 Penjelasan Detail

#### 1. **public/index.php** (Entry Point)
- Semua request HTTP masuk ke sini
- Membaca URL dari `?url=...`
- Mencocokkan dengan routes di `routes/web.php`
- Memanggil Controller yang sesuai

#### 2. **app/controllers/** (Controller)
- Menangani logic aplikasi
- Contoh: `HomeController.php`, `AuctionController.php`
- Setiap controller extends `Controller` class
- Method di controller dipanggil berdasarkan route

#### 3. **app/models/** (Model)
- Berinteraksi dengan database
- Contoh: `User.php`, `Auction.php`, `Bid.php`
- Menggunakan PDO untuk query database

#### 4. **app/Views/** (View)
- File PHP yang berisi HTML
- Dibagi per fitur: `Home/`, `Auction/`, `Auth/`
- Menggunakan layout di `layouts/` (Main.php, Auth.php)

#### 5. **routes/web.php** (Routing)
- Mendefinisikan URL dan controller yang dipanggil
- Format: `"url" => "Controller@method"`
- Contoh: `"home" => "HomeController@index"`

---

## 🚀 Cara Menjalankan Proyek

### Prasyarat:
1. **XAMPP** sudah terinstall (sudah ada di folder XAMPP)
2. **MySQL** database sudah dibuat
3. **Apache** server aktif

### Langkah-langkah:

#### 1. Setup Database
```sql
-- Buat database
CREATE DATABASE db_auction;

-- Import struktur tabel dari Auction_structure.txt
-- Atau jalankan CREATE TABLE statements yang ada di file tersebut
```

#### 2. Konfigurasi Database
Edit file `config/config.php`:
```php
define("DB_HOST", "localhost");
define("DB_NAME", "db_auction");
define("DB_USER", "root");
define("DB_PASS", "");  // Sesuaikan dengan password MySQL Anda
```

#### 3. Setup Base URL
Edit `config/config.php`:
```php
define("BASE_URL", "http://localhost/PW2025/trpw/MiesoAuction/public/");
```
**PENTING:** Sesuaikan path sesuai struktur folder Anda!

#### 4. Jalankan Apache & MySQL
- Buka XAMPP Control Panel
- Start **Apache** dan **MySQL**

#### 5. Akses Aplikasi
Buka browser dan akses:
```
http://localhost/PW2025/trpw/MiesoAuction/public/
```

Atau jika sudah setup `.htaccess` dengan benar:
```
http://localhost/PW2025/trpw/MiesoAuction/public/home
```

---

## ➕ Cara Menambahkan File PHP Baru untuk Frontend

### Contoh: Menambahkan Halaman "Contact Us"

#### **Langkah 1: Buat Controller**
Buat file baru: `app/controllers/ContactController.php`

```php
<?php
class ContactController extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    // Menampilkan form contact
    public function index() {
        $this->view("Contact/index", [
            "title" => "Contact Us",
            "layout" => "Main",
            "custom_css" => "contact",  // opsional
            "custom_js" => "contact"    // opsional
        ]);
    }
    
    // Menangani submit form
    public function store() {
        // Logic untuk menyimpan pesan
        // Redirect atau tampilkan success message
    }
}
```

#### **Langkah 2: Buat View**
Buat folder dan file: `app/Views/Contact/index.php`

```php
<main class="contact-page">
    <div class="container">
        <h1>Contact Us</h1>
        <form action="<?= BASE_URL ?>contact/store" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</main>
```

#### **Langkah 3: Tambahkan Route**
Edit file `routes/web.php`, tambahkan:

```php
return [
    // ... routes yang sudah ada ...
    
    "contact" => "ContactController@index",
    "contact/store" => "ContactController@store",
];
```

#### **Langkah 4: (Opsional) Tambahkan CSS/JS**
- CSS: `public/assets/style/contact.css`
- JS: `public/assets/js/contact.js`

---

## 🔄 Cara Upload ke Branch dan Merge dengan Tim

### Setup Git (Jika Belum Ada)

#### 1. Inisialisasi Git Repository
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/PW2025/trpw
git init
```

#### 2. Buat File .gitignore
Buat file `.gitignore` di root folder:
```
# XAMPP
.htaccess.local

# Database config (jika ada file local)
config/config.local.php

# Uploads (jika tidak ingin commit file upload)
public/uploads/*

# OS files
.DS_Store
Thumbs.db

# IDE
.vscode/
.idea/
*.swp
```

#### 3. Setup Remote Repository
```bash
# Tambahkan remote repository (ganti URL dengan repository tim Anda)
git remote add origin https://github.com/username/repository-name.git

# Atau jika sudah ada:
git remote -v  # Cek remote yang sudah ada
```

### Workflow Git untuk Kolaborasi

#### **Langkah 1: Buat Branch Sendiri**
```bash
# Cek branch yang aktif
git branch

# Buat branch baru untuk fitur Anda
git checkout -b fitur-contact-us

# Atau jika branch sudah ada di remote:
git fetch origin
git checkout -b fitur-contact-us origin/fitur-contact-us
```

#### **Langkah 2: Kerjakan Fitur Anda**
- Edit file-file yang diperlukan
- Test di local
- Pastikan tidak ada error

#### **Langkah 3: Commit Perubahan**
```bash
# Cek file yang berubah
git status

# Tambahkan file yang ingin di-commit
git add app/controllers/ContactController.php
git add app/Views/Contact/index.php
git add routes/web.php

# Atau tambahkan semua perubahan:
git add .

# Commit dengan pesan yang jelas
git commit -m "feat: tambahkan halaman contact us"
```

**Tips Pesan Commit:**
- `feat:` = fitur baru
- `fix:` = perbaikan bug
- `style:` = perubahan styling
- `refactor:` = refactoring code
- `docs:` = dokumentasi

#### **Langkah 4: Push ke Branch Anda**
```bash
# Push ke branch Anda di remote
git push origin fitur-contact-us

# Jika pertama kali push:
git push -u origin fitur-contact-us
```

#### **Langkah 5: Buat Pull Request (PR) / Merge Request**
1. Buka repository di GitHub/GitLab
2. Klik "New Pull Request" atau "Create Merge Request"
3. Pilih:
   - **Base branch:** `main` atau `develop` (branch utama)
   - **Compare branch:** `fitur-contact-us` (branch Anda)
4. Isi deskripsi PR:
   - Apa yang ditambahkan?
   - Bagaimana cara test?
   - Screenshot (jika ada)
5. Tag teman tim untuk review
6. Setelah di-approve, merge ke branch utama

#### **Langkah 6: Update Branch Lokal**
Setelah merge, update branch lokal Anda:

```bash
# Kembali ke branch utama
git checkout main

# Pull perubahan terbaru
git pull origin main

# Hapus branch yang sudah di-merge (opsional)
git branch -d fitur-contact-us
```

### ⚠️ Menghindari Konflik

#### **Sebelum Mulai Coding:**
```bash
# Selalu pull perubahan terbaru
git checkout main
git pull origin main

# Buat branch baru dari main yang ter-update
git checkout -b fitur-baru-saya
```

#### **Jika Ada Konflik:**
```bash
# Saat merge, jika ada konflik:
git checkout main
git pull origin main
git checkout fitur-saya
git merge main  # Atau: git rebase main

# Edit file yang konflik, lalu:
git add .
git commit -m "fix: resolve merge conflict"
git push origin fitur-saya
```

---

## 📝 Checklist Sebelum Push

- [ ] Code sudah di-test dan berjalan dengan baik
- [ ] Tidak ada error PHP
- [ ] File yang diubah sudah di-add (`git add`)
- [ ] Commit message jelas dan deskriptif
- [ ] Sudah pull perubahan terbaru dari main branch
- [ ] Tidak ada file sensitif yang ter-commit (password, dll)

---

## 🆘 Troubleshooting

### Error: "404 Not Found"
- Cek `config/config.php` - pastikan `BASE_URL` benar
- Cek `routes/web.php` - pastikan route sudah terdaftar
- Pastikan controller dan method ada

### Error: "Class not found"
- Pastikan nama file controller sama dengan nama class
- Pastikan file sudah di-require di `public/index.php` atau di controller

### Error Database Connection
- Cek MySQL sudah running
- Cek username/password di `config/config.php`
- Pastikan database sudah dibuat

### Git: "Permission denied"
- Cek SSH key sudah di-setup
- Atau gunakan HTTPS dengan personal access token

---

## 📞 Struktur URL yang Bekerja

Berdasarkan routing yang ada:
- `http://localhost/.../public/` → Home
- `http://localhost/.../public/home` → Home
- `http://localhost/.../public/login` → Login
- `http://localhost/.../public/register` → Register
- `http://localhost/.../public/auctions` → List Auctions
- `http://localhost/.../public/auction/show/1` → Detail Auction ID 1
- `http://localhost/.../public/admin/dashboard` → Admin Dashboard

---

**Selamat Coding! 🚀**

