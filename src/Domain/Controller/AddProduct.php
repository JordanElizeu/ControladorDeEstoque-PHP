<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;
use PDO;

class AddProduct implements InterfaceControllerRequisition
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function processRequisition()
    {
        //list of categories to fill the screen with options category
        $categories = new PdoCategoryRepository($this->connection);
        $listCategories = $categories->AllCategories();
        require __DIR__ . '/../../../view/html/addProduct.php';
    }
}