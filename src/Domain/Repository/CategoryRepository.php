<?php

namespace DesafioBackend\Domain\Repository;

use DesafioBackend\Domain\Model\Category;

/** @version 0.7 */
interface CategoryRepository
{
    /** @return array */
    public function AllCategories(): array;

    /**
     * @param Category $category
     * @return array
     */
    public function findByName(Category $category): array;

    /**
     * @param Category $category
     * @return bool
     */
    public function save(Category $category): bool;

    /**
     * @param Category $category
     * @return bool
     */
    public function remove(Category $category): bool;
}