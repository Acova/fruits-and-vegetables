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
        $this->persist(DoctrineFruit::fromModelFruit($fruit));
    }

    public function remove(Fruit $fruit): void
    {
        $doctrineFruit = $this->find($fruit->getId());

        $entityManager = $this->getEntityManager();
        $entityManager->remove($doctrineFruit);
        $entityManager->flush();
    }

    public function update(Fruit $fruit): void
    {
        $doctrineFruit = $this->find($fruit->getId());
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
        /** @var DoctrineFruit */
        $doctrineFruit = $this->find($id);

        return $doctrineFruit->toModelFruit();
    }

    private function persist(DoctrineFruit $fruit): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($fruit);
        $entityManager->flush();
    }
}