<?php

namespace DesafioBackend\Domain\Controller;

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use DesafioBackend\Infrastructure\Repository\PdoCategoryRepository;
use PDO;

/** @version 1.2 */
class PersistenceSaveCategory implements InterfaceControllerRequisition
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
        if($name != null){
            $product = new Category(
                $name,
                null,
            );

            $repository = new PdoCategoryRepository($this->connection);
            $repository->save($product);

            header('Location: /categories',true,302);
        }else{
            //caso algum valor for nulo redireciona para o
            //própria pagina de adicionar categoria
            header('Location: /addCategory',true,302);
        }
    }
}
