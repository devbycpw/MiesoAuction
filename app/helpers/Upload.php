<?php

class Upload {

    public static function save($file, $folder = "auction_images", $maxSize = 2_000_000) {
        // Cek apakah file ada
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Validasi ekstensi
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            return false; // Ekstensi tidak valid
        }

        // Validasi ukuran file
        if ($file['size'] > $maxSize) {
            return false; // Kebesaran
        }

        // Nama file baru (random)
        $newName = uniqid("img_", true) . "." . $ext;

        // Path tujuan
        $uploadPath = __DIR__ . "/../../public/uploads/$folder/";

        // Buat folder jika belum ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Full path file
        $destination = $uploadPath . $newName;

        // Simpan file fisik
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $newName; // return name untuk disimpan di DB
        }

        return false; // jika gagal upload
    }
}
