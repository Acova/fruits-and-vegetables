<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\FruitsRepository;

class ShowFruit
{
    public function __construct(
        private FruitsRepository $fruitRepository
    ){ 
    }

    public function __invoke(int $id)
    {
        return $this->fruitRepository->search($id);
    }
}