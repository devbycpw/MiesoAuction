<?php
class Upload {

    public static function save($file, $folder = "auction_images", $maxSize = 2_000_000, $width = 500, $height = 500) {
        // Cek file
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Validasi ekstensi
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) return false;

        // Validasi ukuran
        if ($file['size'] > $maxSize) return false;

        // Path folder
        $uploadPath = __DIR__ . "/../../public/assets/uploads/$folder/";
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

        $newName = uniqid("img_", true) . "." . $ext;
        $destination = $uploadPath . $newName;

        // Ambil info gambar
        list($origWidth, $origHeight, $type) = getimagesize($file['tmp_name']);

        // Buat image resource
        switch ($type) {
            case IMAGETYPE_JPEG: $srcImg = imagecreatefromjpeg($file['tmp_name']); break;
            case IMAGETYPE_PNG:  $srcImg = imagecreatefrompng($file['tmp_name']);  break;
            case IMAGETYPE_WEBP: $srcImg = imagecreatefromwebp($file['tmp_name']); break;
            default: return false;
        }

        // Crop center
        $srcSize = min($origWidth, $origHeight);
        $srcX = ($origWidth - $srcSize) / 2;
        $srcY = ($origHeight - $srcSize) / 2;

        // Resize + crop
        $dstImg = imagecreatetruecolor($width, $height);
        imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $width, $height, $srcSize, $srcSize);

        // Simpan hasil
        switch ($type) {
            case IMAGETYPE_JPEG: imagejpeg($dstImg, $destination, 90); break;
            case IMAGETYPE_PNG:  imagepng($dstImg, $destination); break;
            case IMAGETYPE_WEBP: imagewebp($dstImg, $destination); break;
        }

        // Hapus memory
        imagedestroy($srcImg);
        imagedestroy($dstImg);

        return $newName;
    }
}
?>