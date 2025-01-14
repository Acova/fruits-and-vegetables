<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\FruitsRepository;

class ListFruits
{
    public function __construct(
        private FruitsRepository $fruitRepository
    ){ 
    }

    public function __invoke()
    {
        return $this->fruitRepository->list();
    }
}