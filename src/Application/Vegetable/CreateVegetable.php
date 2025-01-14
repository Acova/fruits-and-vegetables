<?php

namespace App\Application\Vegetable;

use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;

class CreateVegetable
{
    public function __construct(
        private VegetablesRepository $vegetablesRepository
    ){ 
    }

    public function __invoke(VegetableDTO $vegetableDTO)
    {
        $vegetable = (new Vegetable())
            ->setId($vegetableDTO->id)
            ->setName($vegetableDTO->name)
            ->setQuantity($vegetableDTO->quantity);

        return $this->vegetablesRepository->add($vegetable);
    }
}