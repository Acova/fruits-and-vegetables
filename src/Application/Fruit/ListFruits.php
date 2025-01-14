<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\FruitRepository;

class ListFruits
{
    public function __construct(
        private FruitRepository $fruitRepository
    ){ 
    }

    public function __invoke()
    {
        return $this->fruitRepository->list();
    }
}