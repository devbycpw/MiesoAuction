<!-- app/helpers/auth/Auth.php -->
<?php

class Auth {

    public static function check() {
        return Session::get('user_id') !== null;
    }

    public static function user() {
        return Session::get('user_id');
    }

    public static function login($userId) {
        Session::set('user_id', $userId);
    }

    public static function logout() {
        // Pastikan session aktif
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Hapus semua data dari session
        session_unset();

        // Hancurkan session dari server
        session_destroy();

        // Hapus cookie session agar browser tidak menyimpan session lama
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 3600,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Regenerasi session ID baru
        session_start();
        session_regenerate_id(true);
    }

    public static function redirectIfNotAuthenticated() {
        if (!self::check()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }
}
