<?php

namespace DesafioBackend\Domain\Model;

class Product
{
    private string $name;
    private ?int $id;
    private float $price;
    private string $description;
    private int $quantity;
    private array $category;

    public function __construct(string $name,?int $id,float $price,string $description,int $quantity)
    {
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function addCategory(String $name,int $id): void
    {
        $this->category[] = new Category($name,$id);
    }

    public function getCategory(): array
    {
        return $this->category;
    }

    public function defineId(int $id)
    {
        if (!is_null($this->id)){
            throw new \DomainException('Você só pode definir o ID uma vez');
        }

        $this->id = $id;
    }

}