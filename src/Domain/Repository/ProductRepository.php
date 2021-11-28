<?php

namespace DesafioBackend\Domain\Repository;

use DesafioBackend\Domain\Model\Product;

interface ProductRepository
{
    public function AllProducts(): array;
    public function findByName(Product $product): array;
    public function save(Product $product): bool;
    public function remove(Product $product): bool;
}