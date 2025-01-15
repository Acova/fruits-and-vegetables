<?php

namespace App\Application\Fruit;

use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;

class ListFruits
{
    public function __construct(
        private FruitsRepository $fruitRepository
    ){ 
    }

    public function __invoke(array $filter = [])
    {
        $list = $this->fruitRepository->list($filter);
        if (isset($filter['unit']) && 'kg' === $filter['unit']) {
            /** @var Fruit */
            foreach($list as $fruit) {
                $fruit->setQuantity($fruit->getQuantity() / 1000);
            }
        }

        return $list;
    }
}