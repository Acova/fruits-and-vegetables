<?php

namespace App\Application\Vegetable;

use App\Domain\Vegetables\VegetablesRepository;

class ListVegetables
{
    public function __construct(
        private VegetablesRepository $vegetablesRepository
    ) {
    }

    public function __invoke()
    {
        return $this->vegetablesRepository->list();
    }
}