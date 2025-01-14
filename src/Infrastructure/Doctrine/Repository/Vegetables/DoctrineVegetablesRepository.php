<?php

namespace App\Infrastructure\Doctrine\Repository\Vegetables;

use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;
use App\Infrastructure\Doctrine\Entity\Vegetables\DoctrineVegetable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineVegetablesRepository extends ServiceEntityRepository implements VegetablesRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineVegetable::class);
    }

    public function add(Vegetable $vegetable): void
    {
        $this->persist(DoctrineVegetable::fromModelVegetable($vegetable));
    }

    public function remove(Vegetable $vegetable): void
    {
        $doctrineVegetable = $this->find($vegetable->getId());

        $entityManager = $this->getEntityManager();
        $entityManager->remove($doctrineVegetable);
        $entityManager->flush();
    }

    public function update(Vegetable $vegetable): void
    {
        $doctrineVegetable = $this->find($vegetable->getId());
        $doctrineVegetable->setName($vegetable->getName());
        $doctrineVegetable->setQuantity($vegetable->getQuantity());

        $this->persist($doctrineVegetable);
    }

    public function list(): array
    {
        return $this->findAll();
    }

    public function search(int $id): ?Vegetable
    {
        /** @var DoctrineVegetable */
        $doctrineVegetable = $this->find($id);

        return $doctrineVegetable->toModelVegetable();
    }

    private function persist(DoctrineVegetable $vegetable): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($vegetable);
        $entityManager->flush();
    }
}