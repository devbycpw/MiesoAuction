# ⚡ Quick Start Guide

## 🚀 Menjalankan Proyek (5 Menit)

### 1. Setup Database
```sql
CREATE DATABASE db_auction;
-- Import tabel dari Auction_structure.txt
```

### 2. Edit Config
File: `config/config.php`
```php
define("BASE_URL", "http://localhost/PW2025/trpw/MiesoAuction/public/");
```

### 3. Start XAMPP
- Start Apache
- Start MySQL

### 4. Akses
```
http://localhost/PW2025/trpw/MiesoAuction/public/
```

---

## ➕ Menambah Halaman Baru (3 Langkah)

### 1. Controller
`app/controllers/NamaController.php`
```php
<?php
class NamaController extends Controller {
    public function index() {
        $this->view("Nama/index", [
            "title" => "Judul Halaman",
            "layout" => "Main"
        ]);
    }
}
```

### 2. View
`app/Views/Nama/index.php`
```php
<main>
    <h1>Halaman Saya</h1>
</main>
```

### 3. Route
`routes/web.php`
```php
"nama-halaman" => "NamaController@index",
```

**Selesai!** Akses: `http://localhost/.../public/nama-halaman`

---

## 🔄 Git Workflow Singkat

```bash
# 1. Update dari main
git checkout main
git pull origin main

# 2. Buat branch baru
git checkout -b fitur-saya

# 3. Kerjakan fitur
# ... edit file ...

# 4. Commit
git add .
git commit -m "feat: tambahkan fitur X"

# 5. Push
git push origin fitur-saya

# 6. Buat Pull Request di GitHub/GitLab
```

---

## 📁 Struktur Singkat

- `public/` → Entry point (index.php)
- `app/controllers/` → Logic aplikasi
- `app/Views/` → Tampilan HTML
- `app/models/` → Database queries
- `routes/web.php` → URL routing

---

Lihat `PANDUAN_PROYEK.md` untuk penjelasan lengkap!

