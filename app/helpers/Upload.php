<?php

class Upload {
    private static $lastError = null;

    public static function getLastError() {
        return self::$lastError;
    }

    public static function save($file, $folder = "auction_images", $maxSize = 10_000_000) {
        self::$lastError = null;
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            self::$lastError = "Upload error code: " . ($file['error'] ?? 'no_file');
            return false;
        }

        $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'heic', 'heif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            self::$lastError = "Invalid extension: .$ext";
            return false; 
        }

        if ($file['size'] > $maxSize) {
            self::$lastError = "File too large: " . $file['size'] . " bytes";
            return false; 
        }

        $newName = uniqid("img_", true) . "." . $ext;
        $uploadPath = __DIR__ . "/../../public/assets/uploads/$folder/";

        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0777, true) && !is_dir($uploadPath)) {
                self::$lastError = "Cannot create upload directory";
                return false;
            }
        }

        $destination = $uploadPath . $newName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $newName; 
        }

        self::$lastError = "move_uploaded_file failed";
        return false; 
    }
}
