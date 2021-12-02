<?php

namespace DesafioBackend\Domain\Model;

class Category
{
    /** @var string  */
    private string $name;
    /** @var int|null */
    private ?int $id;

    public function __construct(string $name,?int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return void
     */
    public function changeName($name):void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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