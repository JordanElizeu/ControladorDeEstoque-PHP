<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;

/** @version 0.5 */
class Dashboard implements InterfaceControllerRequisition
{
    public function __construct()
    {
        //ready to use builder when you need it
    }

    public function processRequisition()
    {
        // Instância de connection para iniciar a conexão com o banco
        $connection = ConnectionCreator::createConnection();
        $categories = new PdoCategoryRepository($connection);
        // Pega todos os valores do array categories e insere ao listCategories
        $listCategories = $categories->AllCategories();

        // Pega todos os valores do array products e insere ao listProducts
        $products = new PdoProductRepository($connection);
        $listProducts = $products->AllProducts();

        require __DIR__ . '/../../../view/html/dashboard.php';
    }
}