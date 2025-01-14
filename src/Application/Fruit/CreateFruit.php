<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitRepository;

class CreateFruit
{
    public function __construct(
        private FruitRepository $fruitRepository
    ){ 
    }

    public function __invoke(FruitDTO $fruitDTO)
    {
        $fruit = (new Fruit())
            ->setId($fruitDTO->id)
            ->setName($fruitDTO->name)
            ->setQuantity($fruitDTO->quantity);

        return $this->fruitRepository->add($fruit);
    }
}