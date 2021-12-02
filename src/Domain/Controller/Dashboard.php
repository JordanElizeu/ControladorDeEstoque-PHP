<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

class Dashboard implements InterfaceControllerRequisition
{
    public function __construct()
    {
        //ready to use builder when you need it
    }

    public function processRequisition()
    {
        $connection = ConnectionCreator::createConnection();
        $categories = new PdoProductRepository($connection);
        $listCategories = $categories->AllProducts();

        $products = new PdoProductRepository($connection);
        $listProducts = $products->AllProducts();

        require __DIR__ . '/../../../view/html/dashboard.php';
    }
}