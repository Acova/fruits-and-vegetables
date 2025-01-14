<?php

namespace App\Application\Vegetable;

use App\Domain\Vegetables\VegetablesRepository;

class ShowVegetable
{
    public function __construct(
        private VegetablesRepository $vegetablesRepository
    ) {
    }

    public function __invoke(int $id)
    {
        return $this->vegetablesRepository->search($id);
    }
}