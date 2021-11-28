<?php

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';

$connection = new PDO('sqlite:' . $databasePath);

$createTableSql = '
    CREATE TABLE product (
        id INTEGER PRIMARY KEY,
        name TEXT,
        price DECIMAL,
        description TEXT,
        quantity INTEGER
    );
';

$connection->exec($createTableSql);