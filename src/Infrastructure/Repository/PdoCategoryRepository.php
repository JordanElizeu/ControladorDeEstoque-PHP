<?php

namespace DesafioBackend\Infrastructure\Repository;

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Domain\Model\Product;
use DesafioBackend\Domain\Repository\ProductRepository;
use PDO;
use PDOStatement;

class PdoCategoryRepository implements ProductRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function AllProducts(): array
    {
        $sqlQuery = 'SELECT * FROM category';
        $statement = $this->connection->query($sqlQuery);

        return $this->hydrateCategoryList($statement);
    }

    public function findByName(Product $product): array
    {
        $sqlQuery = 'SELECT * FROM category WHERE name = ?;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1,$product->getName());
        $statement->execute();
        return $this->hydrateCategoryList($statement);
    }

    private function hydrateCategoryList(PDOStatement $statement): array
    {
        $categoryDataList = $statement->fetchAll();
        $categoryList = [];

        foreach ($categoryDataList as $categoryData){
            $categoryList[] = new Category(
              $categoryData['name'],
              $categoryData['id']
            );
        }

        return $categoryList;
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
        $statement = $this->connection->prepare('DELETE FROM category WHERE id = ?;');
        $statement->bindValue(1,$product->getId(),PDO::PARAM_INT);
        return $statement->execute();
    }

    private function update(Product $product): bool
    {
        $updateQuery = 'UPDATE category SET name = :name WHERE id = :id;';
        $statement = $this->connection->prepare($updateQuery);
        $statement->bindValue(':name', $product->getName());
        $statement->bindValue(':id',$product->getId(),PDO::PARAM_INT);
        return $statement->execute();
    }

    private function insert(Product $product): bool
    {
        $insertQuery = "INSERT INTO category (name) VALUES (:name);";
        $statement = $this->connection->prepare($insertQuery);

        $success = $statement->execute([
            ':name' => $product->getName(),
        ]);

        if($success) {
            $product->defineId($this->connection->lastInsertId());
        }

        return $success;
    }
}