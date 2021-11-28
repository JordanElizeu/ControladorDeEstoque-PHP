<?php

namespace DesafioBackend\Infrastructure\Repository;

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Domain\Repository\CategoryRepository;
use DesafioBackend\Infrastructure\Persistence\ConnectionCreator;
use PDO;

class PdoCategoryRepository implements CategoryRepository
{

    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function findAllCategories(): array
    {
        $statement = $this->connection->prepare('SELECT * FROM category');
        $categoryDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
        $categoryList = [];
        foreach ($categoryDataList as $categoryData){
            $categoryList[] = new Category($categoryData['name'],$categoryData['id']);
        }
        return $categoryList;
    }

    public function findNameCategory(): array
    {
        $statement = $this->connection->prepare('SELECT FROM category WHERE name = ?');
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function save(Category $category): bool
    {
        $sqlInsert = "INSERT INTO category (name) VALUES ('{$category->getName()}')";
        var_dump($this->connection->exec($sqlInsert));
    }

    public function delete(Category $category): bool
    {
        try
        {
            $statement = $this->connection->prepare
                ("DELETE FROM category WHERE id = {$category->getId()}");
            $this->connection->exec($statement);
            return true;
        }catch (\Exception)
        {
            return false;
        }
    }

    public function edit(Category $category): bool
    {
        try
        {
            $statement = $this->connection->prepare
            ("UPDATE category SET name = {$category->getName()}");
            $this->connection->exec($statement);
            return true;
        }catch (\Exception)
        {
            return false;
        }
    }
}