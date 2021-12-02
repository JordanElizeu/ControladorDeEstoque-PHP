<?php

namespace DesafioBackend\Infrastructure\Repository;

use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Domain\Repository\ProductRepository;
use PDO;
use PDOStatement;

/** @version 1.0 */
class PdoProductRepository implements ProductRepository
{
    /** @var PDO
     *  @access private
     */
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /** @return array
     * pegar todos os valores do banco e retorna um array
     */
    public function AllProducts(): array
    {
        //get all values of products in database and return an array
        $sqlQuery = 'SELECT * FROM product';
        $statement = $this->connection->query($sqlQuery);

        return $this->hydrateProductList($statement);
    }

    /**
     * @param Product $product
     * @return array
     * faz busca por produtos com nome especifico
     */
    public function findByName(Product $product): array
    {
        //search of name
        $sqlQuery = 'SELECT * FROM product WHERE name = ?;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1, $product->getName());
        $statement->execute();
        return $this->hydrateProductList($statement);
    }

    /**
     * @param PDOStatement $statement
     * @return array
     * trata os dados do array contendo produtos
     */
    private function hydrateProductList(PDOStatement $statement): array
    {
        //hydrate list of product and return self
        $productDataList = $statement->fetchAll();
        $productList = [];

        foreach ($productDataList as $categoryData) {
            $productList[] = $product = new Product(
                $categoryData['name'],
                $categoryData['id'],
                $categoryData['price'],
                $categoryData['description'],
                $categoryData['quantity'],
                $categoryData['sku'],
            );
            $this->fillCategoryOf($product);
        }

        return $productList;
    }

    /**
     * @param Product $product
     * @return bool
     * metodo de salvar
     */
    public function save(Product $product): bool
    {
        if ($product->getId() === null) {
            //insert a new product if id is null
            return $this->insert($product);
        }
        //update a product existent if id is not null
        return $this->update($product);
    }

    /**
     * @param Product $product
     * @return bool
     * metodo de remover
     */
    public function remove(Product $product): bool
    {
        //remove a product
        $statement = $this->connection->prepare('DELETE * FROM product WHERE id = ?;');
        $statement->bindValue(1, $product->getId(), PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * @param Product $category
     * @return bool
     * metodo de atualizar
     */
    private function update(Product $category): bool
    {
        //update a product
        $updateQuery = 'UPDATE product SET name = :name, price = :price, description = :description, quantity = :quantity WHERE id = :id;';
        $statement = $this->connection->prepare($updateQuery);
        $statement->bindValue(':name', $category->getName());
        $statement->bindValue(':price', $category->getPrice());
        $statement->bindValue(':description', $category->getDescription());
        $statement->bindValue(':quantity', $category->getQuantity());
        $statement->bindValue(':id', $category->getId(), PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * @param Product $product
     * @return bool
     * metodo de inserir
     */
    private function insert(Product $product): bool
    {
        //insert a new product
        $insertQuery = "INSERT INTO product (name,price,description,quantity,sku) VALUES (:name,:price,:description,:quantity,:sku);";

        $statement = $this->connection->prepare($insertQuery);

        $success = $statement->execute([
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':description' => $product->getDescription(),
            ':quantity' => $product->getQuantity(),
            ':sku' => $product->getSku(),
        ]);

        if ($success) {
            $product->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    /**
     * @param Product $product
     * @return void
     * esse metodo seria para relacionar a tabela categoria
     * com a tabela de produtos, porém tive problemas
     * para desenvolver e não foi possível implementar
     * todas as funcionalidades a tempo.
     */
    private function fillCategoryOf(Product $product): void
    {
        //here I can't relationship the table category with
        //product table utilizing a new table named "product_category"
        //sorry I tried a lot, but I didn't make it in time.
        $sqlQuery = 'SELECT * FROM product_category WHERE category_id = ?;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1,$product->getId());
        $statement->execute();

        $categoryDataList = $statement->fetchAll();
        //use aggregate.
        foreach ($categoryDataList as $categoryData){
            $product->addCategory(
                $categoryData['name'],
                $categoryData['id']);
        }
    }
}