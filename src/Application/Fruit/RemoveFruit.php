<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\FruitRepository;

class RemoveFruit
{
    public function __construct(
        private FruitRepository $fruitRepository
    ) {    
    }

    public function __invoke($id)
    {
        $fruit = $this->fruitRepository->search($id);
        $this->fruitRepository->remove($fruit);
    }
}