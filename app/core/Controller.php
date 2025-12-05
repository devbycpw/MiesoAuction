<?php
    require __DIR__ . "/../helpers/auth/Auth.php";
    require __DIR__ . "/../helpers/auth/Session.php";

class Controller {

    public function __construct() {}

    protected function view($path, $data = []) {
        extract($data);
        $layout = $data['layout'] ?? 'Main';
        
        ob_start();
        require __DIR__ . "/../Views/$path.php";
        $content = ob_get_clean();
        require __DIR__ . "/../Views/layouts/$layout.php";
    }

    protected function model($name) {
        require __DIR__ . "/../Models/$name.php";
        return new $name;
    }
}
