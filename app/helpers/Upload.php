<?php

class Upload {
    private static $lastError = null;

    public static function getLastError() {
        return self::$lastError;
    }

    public static function save($file, $folder = "auction_images", $maxSize = 10_000_000) {
        self::$lastError = null;

        // Cek apakah file ada
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            self::$lastError = "Upload error code: " . ($file['error'] ?? 'no_file');
            return false;
        }

        // Validasi ekstensi
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'heic', 'heif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            self::$lastError = "Invalid extension: .$ext";
            return false; // Ekstensi tidak valid
        }

        // Validasi ukuran file
        if ($file['size'] > $maxSize) {
            self::$lastError = "File too large: " . $file['size'] . " bytes";
            return false; // Kebesaran
        }

        // Nama file baru (random)
        $newName = uniqid("img_", true) . "." . $ext;

        // Path tujuan
        $uploadPath = __DIR__ . "/../../public/assets/uploads/$folder/";

        // Buat folder jika belum ada
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0777, true) && !is_dir($uploadPath)) {
                self::$lastError = "Cannot create upload directory";
                return false;
            }
        }

        // Full path file
        $destination = $uploadPath . $newName;

        // Simpan file fisik
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $newName; // return name untuk disimpan di DB
        }

        self::$lastError = "move_uploaded_file failed";
        return false; // jika gagal upload
    }
}
