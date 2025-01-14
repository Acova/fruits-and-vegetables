<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\FruitRepository;

class ShowFruit
{
    public function __construct(
        private FruitRepository $fruitRepository
    ){ 
    }

    public function __invoke(int $id)
    {
        return $this->fruitRepository->search($id);
    }
}