<?php

namespace App\Application\Vegetable;

use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;

class ListVegetables
{
    public function __construct(
        private VegetablesRepository $vegetablesRepository
    ) {
    }

    public function __invoke(array $filter = [])
    {
        $list = $this->vegetablesRepository->list();
        if (isset($filter['unit']) && 'kg' === $filter['unit']) {
            /** @var Vegetable */
            foreach($list as $vegetable) {
                $vegetable->setQuantity($vegetable->getQuantity() / 1000);
            }
        }

        return $list;
    }
}