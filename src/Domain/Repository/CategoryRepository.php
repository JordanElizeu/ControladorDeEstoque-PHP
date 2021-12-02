<?php

namespace DesafioBackend\Domain\Repository;

use DesafioBackend\Domain\Model\Category;

interface CategoryRepository
{
    public function AllCategories(): array;
    public function findByName(Category $category): array;
    public function save(Category $category): bool;
    public function remove(Category $category): bool;
}