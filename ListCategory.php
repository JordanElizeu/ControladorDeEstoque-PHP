<?php

use DesafioBackend\Domain\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Domain\Model\Category;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$statement = $pdo->query('SELECT * FROM category');
$categoryDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$categoryList = [];


foreach ($categoryDataList as $categoryData){
    $categoryList[] = new Category($categoryData['name'],$categoryData['id']);
}

var_dump($categoryList);