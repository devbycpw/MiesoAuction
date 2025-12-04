<?php
// routes/web.php (Tambahkan rute ini)
return [
    "" => "HomeController@index",
    "home" => "HomeController@index",

    // Rute Login
    "login" => "AuthController@showLogin",
    "login/auth" => "AuthController@login",
    "logout" => "AuthController@logout",

    // Rute Registrasi BARU
    "register" => "AuthController@showRegister", // Menampilkan form (GET)
    "register/create" => "AuthController@register" // Memproses form (POST)
];