<?php

// Fetch method and URI from somewhere
require_once 'routes.php';

use Responses\ErrorResponse;

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo json_encode(new ErrorResponse('method not found'), JSON_UNESCAPED_UNICODE);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo json_encode(new ErrorResponse('method not allowed'), JSON_UNESCAPED_UNICODE);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$class, $method] = explode("@", $handler, 2);
        $class = '\\Controllers\\' . $class;

        echo call_user_func_array([new $class, $method], $vars);
        break;
}
