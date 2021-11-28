<?php

namespace DesafioBackend\Domain\Model;

class Product
{
    private $name;
    private $id;
    private $price;
    private $description;
    private $quantity;
    private $category;

    public function __construct($name,$id,$price,$description,$quantity,$category)
    {
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->category = $category;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }


}