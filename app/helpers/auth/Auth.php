<?php

class Auth {

    public static function check() {
        return Session::get('user_id') !== null;
    }

    public static function login($user)
    {
        Session::set('user_id', $user['id']);
        Session::set('full_name', $user['full_name']);
        Session::set('role', $user['role']);
    }

    public static function user($key = null)
    {
        if (!self::check()) return null;

        if ($key) {
            return Session::get($key);
        }

        return [
            'id' => Session::get('user_id'),
            'full_name' => Session::get('full_name'),
            'role' => Session::get('role')
        ];
    }

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

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

        session_start();
        session_regenerate_id(true);
    }

    public static function isAdmin() {
        return Session::get('role') === 'admin';
    }

    public static function isClient() {
        return Session::get('role') === 'client';
    }

    public static function redirectAdmin() {
        if (!self::check() || !self::isAdmin()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

    public static function redirectClient() {
        if (!self::check() || !self::isClient()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

    public static function redirectIfNotAuthenticated() {
        if (!self::check()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }
}
