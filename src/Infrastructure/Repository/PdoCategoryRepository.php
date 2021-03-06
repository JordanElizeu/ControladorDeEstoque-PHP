<?php

namespace DesafioBackend\Infrastructure\Repository;

use DesafioBackend\Domain\Model\Category;
use DesafioBackend\Domain\Repository\CategoryRepository;
use PDO;
use PDOStatement;

/** @version 1.0 */
class PdoCategoryRepository implements CategoryRepository
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
    public function AllCategories(): array
    {
        //get categories list of database
        $sqlQuery = 'SELECT * FROM category';
        $statement = $this->connection->query($sqlQuery);

        return $this->hydrateCategoryList($statement);
    }

    /**
     * @param Category $category
     * @return array
     * faz uma busca por nome da categoria
     */
    public function findByName(Category $category): array
    {
        //search for name
        $sqlQuery = 'SELECT * FROM category WHERE name = ?;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(1,$category->getName());
        $statement->execute();
        return $this->hydrateCategoryList($statement);
    }

    /**
     * @param PDOStatement $statement
     * @return array
     * trata os dados do array de categoria
     */
    private function hydrateCategoryList(PDOStatement $statement): array
    {
        //hydrate the list category and return self
        $categoryDataList = $statement->fetchAll();
        $categoryList = [];

        foreach ($categoryDataList as $categoryData){
            $categoryList[] = new Category(
              $categoryData['name'],
              $categoryData['id'],
            );
        }

        return $categoryList;
    }

    /**
     * @param Category $category
     * @return bool
     * metodo de salvar dados que possue um condicional
     * para verificar se é necessário adicionar nova
     * categoria ou apenas atualizar categoria
     * existente.
     */
    public function save(Category $category): bool
    {
        if ($category->getId() === null) {
            //if id is null so save a new category
            return $this->insert($category);
        }
        //if id is not null so update existent category with this id
        return $this->update($category);
    }

    /**
     * @param Category $category
     * @return bool
     * metodo de remover categoria
     */
    public function remove(Category $category): bool
    {
        //remove a category
        $statement = $this->connection->prepare('DELETE FROM category WHERE id = ?;');
        $statement->bindValue(1,$category->getId(),PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * @param Category $category
     * @return bool
     * metodo de atualizar categoria
     */
    private function update(Category $category): bool
    {
        //update a category
        $updateQuery = 'UPDATE category SET name = :name WHERE id = :id;';
        $statement = $this->connection->prepare($updateQuery);
        $statement->bindValue(':name', $category->getName());
        $statement->bindValue(':id',$category->getId(),PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * @param Category $category
     * @return bool
     * metodo de inserir categoria
     */
    private function insert(Category $category): bool
    {
        //insert a new category
        $insertQuery = "INSERT INTO category (name, product_id) VALUES (:name, :product_id);";
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