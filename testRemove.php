<?php

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';

$connection = new PDO('sqlite:' . $databasePath);

$createTableSql = '
    DROP TABLE category;
    DROP TABLE product;
    DROP TABLE product_category;
';

$connection->exec($createTableSql);