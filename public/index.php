<?php
require "../app/helpers/auth/Session.php";
Session::start();
require "../app/helpers/auth/Auth.php";

require "../config/config.php";
require "../app/Core/DbConnection.php";
require "../app/Core/Controller.php";

$uri = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$routes = require "../routes/web.php";
$found = false;

foreach ($routes as $route => $handler) {
    $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([0-9]+)', $route);
    $pattern = "@^" . $pattern . "$@";

    if (preg_match($pattern, $uri, $matches)) {
        list($controller, $method) = explode("@", $handler);
        require "../app/Controllers/$controller.php";

        $obj = new $controller;
        array_shift($matches);

        call_user_func_array([$obj, $method], $matches);
        $found = true;
        break;
    }
}

if (!$found) {
    http_response_code(404);
    echo "404 Not Found";
}
