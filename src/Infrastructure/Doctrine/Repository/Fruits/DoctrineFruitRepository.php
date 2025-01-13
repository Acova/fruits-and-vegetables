<?php

namespace App\Infrastructure\Doctrine\Repository\Fruits;

use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitRepository;
use App\Infrastructure\Doctrine\Entity\Fruits\DoctrineFruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFruitRepository extends ServiceEntityRepository implements FruitRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineFruit::class);
    }

    public function add(Fruit $fruit): void
    {
        $newFruit = new DoctrineFruit();
        $newFruit->setId($fruit->getId());
        $newFruit->setName($fruit->getName());
        $newFruit->setQuantity($fruit->getQuantity());

        $entityManager = $this->getEntityManager();
        $entityManager->persist($newFruit);
        $entityManager->flush();
    }

    public function remove(Fruit $fruit): void
    {
        return;
    }

    public function update(Fruit $fruit): void
    {
        return;
    }

    public function list(): array
    {
        return [];
    }

    public function search(): ?Fruit
    {
        return new Fruit();
    }
}