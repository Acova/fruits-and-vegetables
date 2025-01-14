<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\FruitsRepository;

class RemoveFruit
{
    public function __construct(
        private FruitsRepository $fruitRepository
    ) {    
    }

    public function __invoke($id)
    {
        $fruit = $this->fruitRepository->search($id);
        $this->fruitRepository->remove($fruit);
    }
}