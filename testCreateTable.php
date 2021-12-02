<?php

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';

$connection = new PDO('sqlite:' . $databasePath);

$createTableSql = '
    
    CREATE TABLE category (
        id INTEGER PRIMARY KEY,
        name TEXT
    );
    CREATE TABLE product (
        id INTEGER PRIMARY KEY,
        name TEXT,
        price TEXT,
        description TEXT,
        sku TEXT,
        quantity TEXT
    );
    CREATE TABLE product_category (
        product_id INTEGER,
        category_id INTEGER,
        FOREIGN KEY (product_id) REFERENCES product(id),
        FOREIGN KEY (category_id) REFERENCES category(id),
        PRIMARY KEY (product_id, category_id)
    );
';

$connection->exec($createTableSql);


