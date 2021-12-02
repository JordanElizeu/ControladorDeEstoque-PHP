<?php

require __DIR__ . '/../vendor/autoload.php';

use DesafioBackend\Domain\Controller\InterfaceControllerRequisition;

$path = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../config/router.php';

//if array key not exists so return error 404
if(!array_key_exists($path,$routes)){
    http_response_code(404);
    exit();
}

$classController = $routes[$path];
/** @var InterfaceControllerRequisition $controller */
$controller = new $classController();
$controller->processRequisition();