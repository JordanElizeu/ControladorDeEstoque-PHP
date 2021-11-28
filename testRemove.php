<?php

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';

$connection = new PDO('sqlite:' . $databasePath);

$createTableSql = '
    DROP TABLE product;
';

$connection->exec($createTableSql);