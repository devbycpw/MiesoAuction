<?php

class AuthController extends Controller {

    public function showLogin() {
        $this->view("auth/login",[
            "title" => "Login",
            "layout" => "Auth",
            "custom_css" => "login"
        ]);
    }

    public function showRegister() {
        $this->view("auth/register",[
            "title" => "Registrasi",
            "layout" => "Auth",
            "custom_css" => "register"
        ]);
    }

    public function register() {
        $userModel = $this->model("User");

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($password !== $confirmPassword) {
            Session::set('error', 'Konfirmasi password tidak cocok.');
            header("Location: " . BASE_URL . "register");
            exit;
        }

        if ($userModel->findByEmail($email)) {
            Session::set('error', 'Email sudah terdaftar.');
            header("Location: " . BASE_URL . "register");
            exit;
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];
        
        if ($userModel->create($data)) {
            Session::set('success', 'Pendaftaran berhasil! Silakan login menggunakan akun Anda.');
            header("Location: " . BASE_URL . "login");
            exit;
        } else {
            Session::set('error', 'Gagal mendaftar. Silakan coba lagi.');
            header("Location: " . BASE_URL . "register");
            exit;
        }
    }

    public function login() {
        $userModel = $this->model("User");
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            Auth::login($user); 

            if (Auth::isClient()) {
                header("Location: " . BASE_URL . "home");
            } else {
                header("Location: " . BASE_URL . "admin/auctions");
            }
            exit;
        }

        Session::set('error', 'Email atau password salah.');
        header("Location: " . BASE_URL . "login");
        exit;
    }



    public function logout() {
        Auth::logout();
        header("Location: " . BASE_URL . "login");
        exit;
    }
}
