<?php

namespace DesafioBackend\Domain\Repository;

use DesafioBackend\Domain\Model\Product;

/** @version 0.7 */
interface ProductRepository
{
    /**
     * @return array
     * Variável retorna um array contendo todos os produtos cadastrados
     */
    public function AllProducts(): array;

    /**
     * @param Product $product
     * @return array
     * faz uma busca detalhada com o nome do produto
     */
    public function findByName(Product $product): array;

    /**
     * @param Product $product
     * @return bool
     * metodo para salvar novos produtos
     */
    public function save(Product $product): bool;

    /**
     * @param Product $product
     * @return bool
     * metodo para remover produtos
     */
    public function remove(Product $product): bool;
}