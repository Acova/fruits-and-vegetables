<?php

namespace App\Infrastructure\Doctrine\Entity\Fruits;

use App\Domain\Fruits\Fruit;
USE Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "fruit")]
class DoctrineFruit implements Fruit
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
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