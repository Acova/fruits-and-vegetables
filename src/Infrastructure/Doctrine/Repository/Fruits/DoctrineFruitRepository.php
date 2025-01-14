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

        $this->persist($newFruit);
    }

    public function remove(Fruit $fruit): void
    {
        $doctrineFruit = $this->search($fruit->getId());

        $entityManager = $this->getEntityManager();
        $entityManager->remove($doctrineFruit);
        $entityManager->flush();
    }

    public function update(Fruit $fruit): void
    {
        $doctrineFruit = $this->search($fruit->getId());
        $doctrineFruit->setName($fruit->getName());
        $doctrineFruit->setQuantity($fruit->getQuantity());

        $this->persist($doctrineFruit);
    }

    public function list(): array
    {
        return $this->findAll();
    }

    public function search(int $id): ?Fruit
    {
        return $this->find($id);
    }

    private function persist(DoctrineFruit $fruit): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($fruit);
        $entityManager->flush();
    }
}