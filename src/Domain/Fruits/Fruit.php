<?php

namespace App\Domain\Fruits;

class Fruit
{
    private ?int $id = null;
    private ?string $name = null;
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Fruit
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): Fruit
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }


    public function setQuantity(int $quantity): Fruit
    {
        $this->quantity = $quantity;

        return $this;
    }
}
