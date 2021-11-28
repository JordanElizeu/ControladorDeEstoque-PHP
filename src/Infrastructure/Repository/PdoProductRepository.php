<?php

namespace DesafioBackend\Infrastructure\Repository;

use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Domain\Repository\ProductRepository;
use PDO;
use PDOStatement;

class PdoProductRepository implements ProductRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function AllProducts(): array
    {
        $sqlQuery = 'SELECT * FROM product';
        $statement = $this->connection->query($sqlQuery);

        return $this->hydrateProductList($statement);
    }

    public function findByName(Product $product): array
    {
        $sqlQuery = 'SELECT * FROM product WHERE name = ?;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1, $product->getName());
        $statement->execute();
        return $this->hydrateProductList($statement);
    }

    private function hydrateProductList(PDOStatement $statement): array
    {
        $productDataList = $statement->fetchAll();
        $productList = [];

        foreach ($productDataList as $categoryData) {
            $productList[] = $product = new Product(
                $categoryData['name'],
                $categoryData['id'],
                $categoryData['price'],
                $categoryData['description'],
                $categoryData['quantity'],
            );
            $this->fillCategoryOf($product);
        }

        return $productList;
    }

    public function save(Product $product): bool
    {
        if ($product->getId() === null) {
            return $this->insert($product);
        }
        return $this->update($product);
    }

    public function remove(Product $product): bool
    {
        $statement = $this->connection->prepare('DELETE FROM product WHERE id = ?;');
        $statement->bindValue(1, $product->getId(), PDO::PARAM_INT);
        return $statement->execute();
    }

    private function update(Product $category): bool
    {
        $updateQuery = 'UPDATE product SET name = :name, price = :price, description = :description, quantity = :quantity WHERE id = :id;';
        $statement = $this->connection->prepare($updateQuery);
        $statement->bindValue(':name', $category->getName());
        $statement->bindValue(':price', $category->getPrice());
        $statement->bindValue(':description', $category->getDescription());
        $statement->bindValue(':quantity', $category->getQuantity());
        $statement->bindValue(':id', $category->getId(), PDO::PARAM_INT);
        return $statement->execute();
    }

    private function insert(Product $product): bool
    {
        $insertQuery = "INSERT INTO product (name,price,description,quantity) VALUES (:name,:price,:description,:quantity);";
        $statement = $this->connection->prepare($insertQuery);

        $success = $statement->execute([
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':description' => $product->getDescription(),
            ':quantity' => $product->getQuantity(),
        ]);

        if ($success) {
            $product->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    private function fillCategoryOf(Product $product): void
    {
        $sqlQuery = 'SELECT id, name FROM category WHERE product_id = ?';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1,$product->getId(),PDO::PARAM_INT);
        $statement->execute();

        $categoryDataList = $statement->fetchAll();
        //use aggregate.
        foreach ($categoryDataList as $categoryData){
            $product->addCategory($categoryData['name'],$categoryData['id']);
        }
    }
}