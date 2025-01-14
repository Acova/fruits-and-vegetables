<?php

namespace App\Domain\Vegetables;

class Vegetable
{
    private ?int $id = null;
    private ?string $name = null;
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Vegetable
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): Vegetable
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }


    public function setQuantity(int $quantity): Vegetable
    {
        $this->quantity = $quantity;

        return $this;
    }
}
