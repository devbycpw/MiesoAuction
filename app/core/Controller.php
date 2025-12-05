<?php
class Controller {

    public function __construct() {
        // Bisa ditambah jika butuh loader lain
    }

    protected function view($path, $data = []) {
        extract($data);
        require __DIR__ . "/../Views/$path.php";
    }

    protected function model($name) {
        require __DIR__ . "/../Models/$name.php";
        return new $name;
    }
}
