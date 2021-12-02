<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;

class ListCategory implements InterfaceControllerRequisition
{
    public function __construct()
    {
        //ready to use builder when you need it
    }

    public function processRequisition()
    {
        //here take all categories of database and show in html
        $connection = ConnectionCreator::createConnection();
        $categories = new PdoCategoryRepository($connection);
        $listCategories = $categories->AllCategories();
        require __DIR__ . '/../../../view/html/categories.php';
    }
}