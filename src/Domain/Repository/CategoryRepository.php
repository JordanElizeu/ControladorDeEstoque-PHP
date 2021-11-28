<?php

namespace DesafioBackend\Domain\Repository;

use DesafioBackend\Domain\Model\Category;

interface CategoryRepository
{
    public function findAllCategories(): array;
    public function findNameCategory(): array;
    public function save(Category $category): bool;
    public function delete(Category $category): bool;
    public function edit(Category $category): bool;
}