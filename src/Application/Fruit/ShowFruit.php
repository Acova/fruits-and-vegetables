<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;

class ShowFruit
{
    public function __construct(
        private FruitsRepository $fruitRepository
    ){ 
    }

    public function __invoke(int $id, array $options = [])
    {
        /** @var Fruit */
        $fruit = $this->fruitRepository->search($id);
        if (isset($options['unit']) && 'kg' === $options['unit']) {
            $fruit->setQuantity($fruit->getQuantity() / 1000);
        }

        return $fruit;
    }
}