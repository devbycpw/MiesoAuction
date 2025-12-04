<?php
class Controller {
    protected function view($path, $data = []) {
        extract($data);
        require "../app/views/$path.php";
    }

    protected function model($name) {
        require "../app/models/$name.php";
        return new $name;
    }
}
