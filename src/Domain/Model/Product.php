<?php

namespace DesafioBackend\Domain\Model;

class Product
{
    /** @var string */
    private string $name;
    /** @var int|null */
    private ?int $id;
    /** @var string */
    private string $price;
    /** @var string */
    private string $description;
    /** @var string */
    private string $quantity;
    /** @var string */
    private string $sku;
    /** @var Category[] */
    private array $category;

    public function __construct(string $name,?int $id,string $price,string $description,string $quantity, string $sku)
    {
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->sku = $sku;
    }

    /** @return string */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return void
     */
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param $name
     * @return void
     */
    public function setName($name):void
    {
        $this->name = $name;
    }

    /** @return string */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return void
     */
    public function setPrice($price):void
    {
        $this->price = $price;
    }

    /** @return string */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return void
     */
    public function setDescription($description):void
    {
        $this->description = $description;
    }

    /** @return string */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param $quantity
     * @return void
     */
    public function setQuantity($quantity):void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param String $name
     * @param int $id
     * @return void
     */
    public function addCategory(String $name,int $id): void
    {
        $this->category[] = new Category($name,$id);
    }

    /**
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @param int $id
     * @return void
     */
    public function defineId(int $id):void
    {
        if (!is_null($this->id)){
            throw new \DomainException('Você só pode definir o ID uma vez');
        }

        $this->id = $id;
    }

}