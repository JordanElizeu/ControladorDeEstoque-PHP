<?php

use DesafioBackend\Domain\Controller\{AddCategory,
    AddProduct,
    Dashboard,
    ListCategory,
    ListProduct,
    PersistenceSaveCategory,
    PersistenceSaveProduct};

/** @return string */
//return the value of route
return [
    '/addProduct' => AddProduct::class,
    '/addCategory' => AddCategory::class,
    '/categories' => ListCategory::class,
    '/dashboard' => Dashboard::class,
    '/products' => ListProduct::class,
    '/save-product' => PersistenceSaveProduct::class,
    '/save-category' => PersistenceSaveCategory::class
];