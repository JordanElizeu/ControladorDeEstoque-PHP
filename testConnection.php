<?php

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';
$connection = new PDO('sqlite:' . $databasePath);

//$repository = new PdoCategoryRepository($connection);
//$product = new Category( '222',
//    null);
//var_dump($repository->save($product));

$insertQuery = "INSERT INTO category (name) VALUES ('2');";
$connection->exec($insertQuery);

$insertQuery = "INSERT INTO product (name,price,description,quantity, category_id) VALUES ('3', '3', '3', '3', 1);";
$connection->exec($insertQuery);


//$createTableSql = '
//    SELECT * FROM product;
//';
//
//$statement = $connection->query($createTableSql);
//var_dump($productDataList = $statement->fetchAll());
