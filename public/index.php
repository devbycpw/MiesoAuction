<?php
require "../config/config.php";
require "../app/Core/DbConnection.php";
require "../app/Core/Controller.php";

$uri = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$routes = require "../routes/web.php";

if (isset($routes[$uri])) {
    list($controller, $method) = explode("@", $routes[$uri]);
    require "../app/Controllers/$controller.php";

    $obj = new $controller;
    $obj->$method();
} else {
    http_response_code(404);
    echo "404 Not Found";
}
