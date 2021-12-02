<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

class ListProduct implements InterfaceControllerRequisition
{
    public function __construct()
    {
    }

    public function processRequisition()
    {
        //here take all products of database and show in html
        $connection = ConnectionCreator::createConnection();
        $product = new PdoProductRepository($connection);
        $listProducts = $product->AllProducts();
        require __DIR__ . '/../../../view/html/products.php';
    }
}