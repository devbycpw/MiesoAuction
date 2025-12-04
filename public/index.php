<?php
require "../config/config.php";
require "../app/core/DbConnection.php";
require "../app/core/Controller.php";

$uri = trim($_SERVER['REQUEST_URI'], "/");
$routes = require "../routes/web.php";

if (isset($routes[$uri])) {
    list($controller, $method) = explode("@", $routes[$uri]);
    require "../app/controllers/$controller.php";

    $obj = new $controller;
    $obj->$method();
} else {
    http_response_code(404);
    echo "404 Not Found";
}
