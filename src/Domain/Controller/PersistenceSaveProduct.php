<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoProductRepository;
use PDO;

/** @version 1.2 */
class PersistenceSaveProduct implements InterfaceControllerRequisition
{
    /** @var PDO
     * Connection recebe a conexão do banco da classe ConnectionCreator
     */
    private PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function processRequisition()
    {
        $filter = new ControllerFilterPersistence();
        //completed form, get all values and save in database
        $name = $filter->filterStringPolyfill($_POST['name']);
        $price = $filter->filterStringPolyfill($_POST['price']);
        $description = $filter->filterStringPolyfill($_POST['description']);
        $quantity = $filter->filterStringPolyfill($_POST['quantity']);
        $sku = $filter->filterStringPolyfill($_POST['sku']);

        if($name != null && $price != null &&
           $description != null && $quantity != null &&
            $sku != null){

            $product = new Product(
                $name, null, $price, $description, $quantity, $sku
            );
            $repository = new PdoProductRepository($this->connection);
            $repository->save($product);

            //change route to dashboard
            header('Location: /dashboard',true,302);
        }else{
            //caso algum valor for nulo redireciona para o
            //própria pagina de adicionar produto
            header('Location: /addProduct',true,302);
        }
    }

}
