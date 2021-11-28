<?php

use DesafioBackend\Domain\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

$sqlDelete = $pdo ->prepare('DELETE FROM category WHERE id = ?');
$sqlDelete ->bindValue(1,4,PDO::PARAM_INT);
var_dump($sqlDelete->execute());