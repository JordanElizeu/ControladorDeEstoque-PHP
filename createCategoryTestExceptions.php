<?php

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();

$categoryRepository = new PdoCategoryRepository($connection);

$connection->beginTransaction();

try{
    $aCategory = new Category('Pedro',null);
    $categoryRepository->save($aCategory);
    $anotherCategory = new Category('João',null);
    $categoryRepository->save($anotherCategory);

    $connection->commit();
} catch (\PDOException $exception){
    echo $exception->getMessage();
    $connection->rollBack();
}
