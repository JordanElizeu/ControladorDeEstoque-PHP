<?php

use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
$repository = new PdoProductRepository($pdo);

$productList = $repository->AllProducts();

var_dump($productList);