<?php

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';
$connection = new PDO('sqlite:' . $databasePath);

$insertQuery = "INSERT INTO category (name) VALUES ('software');";
$connection->exec($insertQuery);

$insertQuery = "INSERT INTO product (name,price,description,quantity,sku) VALUES ('Placa de Vídeo', '1159,90', 'Nvidea', '2','nvidea@d');";
$connection->exec($insertQuery);