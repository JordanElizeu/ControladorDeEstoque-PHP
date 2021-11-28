<?php

namespace DesafioBackend\Infrastructure\Repository;

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Domain\Repository\CategoryRepository;
use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use PDO;
use PDOStatement;

class PdoCategoryRepository implements CategoryRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAllCategories(): array
    {
        $sqlQuery = 'SELECT * FROM category';
        $statement = $this->connection->query($sqlQuery);

        return $this->hydrateCategoryList($statement);
    }

    public function findByCategoryName(Category $category): array
    {
        $sqlQuery = 'SELECT * FROM category WHERE name = ?;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1,$category->getName());
        $statement->execute();
        return $this->hydrateCategoryList($statement);
    }

    private function hydrateCategoryList(PDOStatement $statement): array
    {
        $categoryDataList = $statement->fetchAll();
        $categoryList = [];

        foreach ($categoryDataList as $categoryData){
            $categoryList[] = new Category(
              $categoryData['id'],
              $categoryData['name']
            );
        }

        return $categoryList;
    }

    public function save(Category $category): bool
    {
        if ($category->getId() === null) {
            return $this->insert($category);
        }
        return $this->update($category);
    }

    public function remove(Category $category): bool
    {
        $statement = $this->connection->prepare('DELETE FROM category WHERE id = ?;');
        $statement->bindValue(1,$category->getId(),PDO::PARAM_INT);
        return $statement->execute();
    }

    private function update(Category $category): bool
    {
        $updateQuery = 'UPDATE category SET name = :name WHERE id = :id;';
        $statement = $this->connection->prepare($updateQuery);
        $statement->bindValue(':name', $category->getName());
        $statement->bindValue(':id',$category->getId(),PDO::PARAM_INT);
        return $statement->execute();
    }

    private function insert(Category $category): bool
    {
        $insertQuery = "INSERT INTO categor (name) VALUES (:name);";
        $statement = $this->connection->prepare($insertQuery);

        $success = $statement->execute([
            ':name' => $category->getName()
        ]);

        if($success) {
            $category->defineId($this->connection->lastInsertId());
        }

        return $success;
    }
}