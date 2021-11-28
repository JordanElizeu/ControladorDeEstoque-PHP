<?php

use DesafioBackend\Domain\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Domain\Model\Category;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$category = new Category('Games',0);

$sqlInsert = "INSERT INTO category (name) VALUES ('{$category->getName()}')";

var_dump($pdo ->exec($sqlInsert));