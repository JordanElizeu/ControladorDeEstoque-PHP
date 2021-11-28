<?php

use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';

$connection = new PDO('sqlite:' . $databasePath);

$repository = new PdoProductRepository($connection);
$product = new Product( 'larissa',
    null,
    25.80,
    '22222edsdsd',
    10);
var_dump($repository->save($product));

//$createTableSql = '
//    SELECT * FROM product;
//';
//
//$statement = $connection->query($createTableSql);
//var_dump($productDataList = $statement->fetchAll());
