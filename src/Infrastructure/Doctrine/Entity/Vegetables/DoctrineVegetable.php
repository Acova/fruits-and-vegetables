<?php

namespace App\Infrastructure\Doctrine\Entity\Vegetables;

use App\Domain\Vegetables\Vegetable;
USE Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "vegetable")]
class DoctrineVegetable implements Vegetable
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