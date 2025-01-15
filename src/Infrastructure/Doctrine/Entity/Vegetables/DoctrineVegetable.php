<?php

namespace App\Infrastructure\Doctrine\Entity\Vegetables;

use App\Domain\Vegetables\Vegetable;
use App\Infrastructure\Doctrine\Repository\Vegetables\DoctrineVegetablesRepository;
USE Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctrineVegetablesRepository::class)]
#[ORM\Table(name: "vegetable")]
class DoctrineVegetable
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

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }


    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public static function fromModelVegetable(Vegetable $fruit): DoctrineVegetable
    {
        return (new DoctrineVegetable())
            ->setId($fruit->getId())
            ->setName($fruit->getName())
            ->setQuantity($fruit->getQuantity());
    }

    public function toModelVegetable(): Vegetable
    {
        return (new Vegetable)
            ->setId($this->getId())
            ->setName($this->getName())
            ->setQuantity($this->getQuantity());
    }
}