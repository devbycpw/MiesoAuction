<?php
class Controller {
    protected function view($path, $data = []) {
        extract($data);
        require "../app/Views/$path.php";
    }

    protected function model($name) {
        require "../app/Models/$name.php";
        return new $name;
    }yesika
}
