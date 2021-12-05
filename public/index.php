<?php

require __DIR__ . '/../vendor/autoload.php';

use DesafioBackend\Controller\AddCategory;
use DesafioBackend\Controller\AddProduct;
use DesafioBackend\Controller\Dashboard;
use DesafioBackend\Controller\ListCategory;
use DesafioBackend\Controller\ListProduct;

switch ($_SERVER['PATH_INFO']){
    case '/addCategory':
        $controller = new AddCategory();
        $controller->processRequisition();
        break;
    case '/addProduct':
        $controller = new AddProduct();
        $controller->processRequisition();
        break;
    case '/categories':
        $controller = new ListCategory();
        $controller->processRequisition();
        break;
    case '/dashboard':
        $controller = new Dashboard();
        $controller->processRequisition();
        break;
    case '/product':
        $controller = new ListProduct();
        $controller->processRequisition();
        break;
    default:
        echo 'error 404';
        break;
}